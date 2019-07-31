<?php

namespace App\Listeners;

use App\Events\OrderChangeStatusEvent;
use App\Model\Bet as BetModel;
use App\Model\Order as OrderModel;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderChangeStatusListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderChangeStatusEvent $event)
    {
        if ($event->order->status == OrderModel::STATUS_PAID) {
            \Bet::changeBetsStatus($event->order->bets, BetModel::STATUS_PAID);
        }
    }
}
