<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-29
 * Time: 14:21
 */
namespace App\Services;

use App\Lib\Utils;
use App\Model\Bet as BetModel;
use App\Model\BetTicket as BetTicketModel;
use App\Model\Brand as BrandModel;
use App\Model\Lead as LeadModel;
use App\Model\Order as OrderModel;
use App\Model\OrderTransaction;
use App\Model\User as UserModel;
use App\Services\Contracts\OrderServiceContract;

class OrderService implements OrderServiceContract
{
    public function list()
    {
        return OrderModel::query()
                         ->orderBy('created_at', 'DESC')
                         ->paginate(25);
    }

    public function changeStatus( $status, OrderModel $order )
    {
        $order->status = $status;
        $order->save();
    }

    public function betStatusChanged( OrderModel $order, $status )
    {
        $statusShouldBeChanged = $this->allBetsHaveSameStatus($order, $status);

        if ($statusShouldBeChanged === true) {
            $orderStatus = $this->convertBetStatusToOrderStatus($status);

            $order->status = $orderStatus;
            $order->save();
        }
    }

    protected function convertBetStatusToOrderStatus($status)
    {
        $progress_statuses = [
            BetModel::STATUS_WAITING_DRAW,
            BetModel::STATUS_PLAYED,
            BetModel::STATUS_AUTH_PENDING,
            BetModel::STATUS_NOT_AUTH
        ];

        if (in_array($status, $progress_statuses)) {
            return OrderModel::STATUS_IN_PROGRESS;
        }

        $payouts_statuses = [
            BetModel::STATUS_PAYOUT_PENDING,
            BetModel::STATUS_PAYOUT
        ];

        if (in_array($status, $payouts_statuses)) {
            return OrderModel::STATUS_PAYOUTS;
        }

        $closed_statuses = [
            BetModel::STATUS_CANCELLED,
            BetModel::STATUS_CLOSED
        ];

        if (in_array($status, $closed_statuses)) {
            return OrderModel::STATUS_CLOSED;
        }
    }

    protected function allBetsHaveSameStatus($order, $status)
    {
        $bets = $order->bets;

        foreach ($bets as $bet) {
            if ($bet->status != $status) {
                return false;
            }
        }

        return true;
    }

    public function leadToOrder(LeadModel $lead)
    {
        $orderData = [
            'host' => $lead->host
        ];

        if ($lead->user && $lead->user->profile) {
            $orderData['favicon_url'] = $lead->user->profile->favicon;
        } else {
            $orderData['favicon_url'] = ' ';
        }

        $orderPrice = \ApiOrder::calculateOrderPrice($lead->cart_items);

        $orderData['price'] = $orderPrice;
        $orderData['status'] = OrderModel::STATUS_PAID;
        $orderData['user_id'] = $lead->user->id;

        \DB::beginTransaction();
        try {

            $transaction = \UserAvailableBalance::charge( $orderPrice, $lead->user );

            /** @var OrderModel $order */
            $order = OrderModel::create($orderData);
            $transaction->notes = 'ORDER: ' . $order->id;
            $transaction->save();

            (new OrderTransaction([
                'order_id' => $order->id,
                'transaction_id' => $transaction->id,
                'balance_type' => 'available'
            ]))->save();


            $this->makeBets($order, $lead->cart_items, $lead->user);

            $lead->order_id = $order->id;
            $lead->save();

            \DB::commit();

            return $order;

        } catch (\Exception $e) {
            \DB::rollBack();
            logger()->error($e->getMessage(), [__CLASS__]);

            throw $e;
        }
    }

    protected function makeBets(OrderModel $order, array $items, UserModel $user)
    {
        foreach ($items as $item) {

            $brand = \ApiBrand::getBrand( $item['brand_id'] );

            if ( ! $brand ) {
                logger()->error( 'Brand not found ' . $item['brand_id'], ['ApiOrderService'] );
                continue;
            }

            $drawDate = $this->calculateDrawDates($item, $brand);
            $betData = [
                'price'     => 0.0,
                'status'    => BetModel::STATUS_PAID,
                'brand_id' => $brand->id,
                'user_id'  => $user->id,
                'order_id'  => $order->id
            ];

            if ($brand->api_code == 'de_lotto') {
                $betData['additional_data'] = [
                    'ticket_number' => $item['ticketNumber']
                ];
            }

            if (is_array($drawDate)) {

                foreach ($drawDate as $dDate) {
                    $betData['draw_date'] = $dDate;
                    $bet = BetModel::create($betData);

                    $this->makeTickets($bet, $item, $brand, $user);
                }

            } else {
                $betData['draw_date'] = $drawDate;
                $bet = BetModel::create($betData);
                $this->makeTickets($bet, $item, $brand, $user);
            }
        }
    }

    protected function makeTickets($bet, $item, $brand, $user) {

        $betPrice = 0;

        foreach ($item['tickets'] as $ticket) {
            $price = Utils::calculateLine($brand, $ticket);

            if ($ticket['is_protected'] == 1) {
                $price += Utils::calculateNumberShield($brand);
            }

            $ticketData = [
                'line'  => $ticket['line'],
                'extra_balls' => isset($ticket['special_pool']) ? $ticket['special_pool'] : [],
                'extra_games' => isset($item['extra_games']) ? $item['extra_games'] : [],
                'ticket_number' => $ticket['number'],
                'number_shield' => $ticket['is_protected'] == 1 ? true : false,
                'price' => $price,
                'status' => BetTicketModel::STATUS_WAIT,
                'brand_id' => $brand->id,
                'user_id'  => $user->id,
                'bet_id'    => $bet->id
            ];

            BetTicketModel::create($ticketData);

            $betPrice += $price;

        }

        $bet->price = $betPrice;
        $bet->save();
    }

    protected function calculateDrawDates($item, BrandModel $brand)
    {
        $check_dates = $brand->checkDates;

        if ($item['draw_date'] == 'both') {
            $dates = [];

            $checkDate = $check_dates[0]->next_check_date;
            $period = $check_dates[0]->period;
            $dates[] = Utils::getDrawDate($checkDate, $period);

            $checkDate = $check_dates[1]->next_check_date;
            $period = $check_dates[1]->period;
            $dates[] = Utils::getDrawDate($checkDate, $period);

            return $dates;
        }

        if ($item['draw_date'] == 0) {
            $checkDate = $check_dates[0]->next_check_date;
            $period = $check_dates[0]->period;
            return Utils::getDrawDate($checkDate, $period);
        }

        if ($item['draw_date'] == 1) {
            $checkDate = $check_dates[1]->next_check_date;
            $period = $check_dates[1]->period;
            return Utils::getDrawDate($checkDate, $period);
        }
    }


}
