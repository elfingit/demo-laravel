<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-29
 * Time: 14:21
 */
namespace App\Services;

use App\Events\OrderChangeStatusEvent;
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

        event(new OrderChangeStatusEvent($order));

        return $order;
    }
}
