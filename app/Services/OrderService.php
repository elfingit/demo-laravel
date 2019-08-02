<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-29
 * Time: 14:21
 */
namespace App\Services;

use App\Model\Bet as BetModel;
use App\Model\Order as OrderModel;
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
}
