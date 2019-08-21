<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-29
 * Time: 14:20
 */
namespace App\Services\Contracts;

use App\Model\Lead as LeadModel;
use App\Model\Order as OrderModel;

interface OrderServiceContract
{
    public function list();
    public function changeStatus($status, OrderModel $order);
    public function betStatusChanged(OrderModel $order, $status);
    public function leadToOrder(LeadModel $lead);
}
