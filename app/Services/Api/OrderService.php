<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-29
 * Time: 16:36
 */
namespace App\Services\Api;

use App\Lib\Utils;
use App\Model\BetTicket as BetTicketModel;
use App\Model\Lead as LeadModel;
use App\Model\Order as OrderModel;
use App\Model\OrderTransaction;
use App\Model\User as UserModel;
use App\Model\Bet as BetModel;
use App\Model\Brand as BrandModel;
use App\Services\Api\Contracts\OrderServiceContract;
use Illuminate\Foundation\Http\FormRequest;

class OrderService implements OrderServiceContract
{
    public function create( FormRequest $request, UserModel $user )
    {
        $orderData = $request->only('host', 'favicon_url');

        $orderPrice = $this->calculateOrderPrice($request->get('cart_items'));

        $orderData['price'] = $orderPrice;
        $orderData['status'] = OrderModel::STATUS_PAID;
        $orderData['user_id'] = $user->id;

        \DB::beginTransaction();
        try {

            $transaction = \UserAvailableBalance::charge($orderPrice, $user);

            /** @var OrderModel $order */
            $order = OrderModel::create($orderData);
            $transaction->notes = 'ORDER: ' . $order->id;
            $transaction->save();

            (new OrderTransaction([
                'order_id' => $order->id,
                'transaction_id' => $transaction->id,
                'balance_type' => 'available'
            ]))->save();


            $this->makeBets($order, $request->get('cart_items'), $user);

            if ($request->has('lead_id')) {
                $lead = LeadModel::find($request->get('lead_id'));
                if ($lead) {
                    $lead->order_id = $order->id;
                    $lead->save();
                }
            }

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            \ApiLogger::error($e->getMessage(), [__CLASS__]);

            throw $e;
        }
    }

    protected function makeBets(OrderModel $order, array $items, UserModel $user)
    {
        foreach ($items as $item) {

            $brand = \ApiBrand::getBrand( $item['brand_id'] );

            if ( ! $brand ) {
                \ApiLogger::error( 'Brand not found ' . $item['brand_id'], ['ApiOrderService'] );
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

    public function calculateOrderPrice(array $items)
    {
        $price = 0.0;

        foreach ($items as $item) {
            $brand = \ApiBrand::getBrand($item['brand_id']);

            if (!$brand) {
                \ApiLogger::error('Brand not found ' . $item['brand_id']);
                continue;
            }

            foreach ($item['tickets'] as $ticket) {
                $price += Utils::calculateLine($brand, $ticket);

                if ($ticket['is_protected'] == 1) {
                    $price += Utils::calculateNumberShield($brand);
                }
            }

            if (isset($item['extra_games'])) {
                foreach ($item['extra_games'] as $extra_game) {
                    $price += Utils::calculateExtraGame($brand, $extra_game['system_name'], count($item['tickets']));
                }
            }



            if ($item['draw_date'] == 'both') {
                $price += $price * 2;
            }
        }

        return $price;
    }

}
