<?php

namespace App\Listeners;

use App\Events\BetChangeStatusEvent;
use App\Model\Bet as BetModel;
use App\Model\Order as OrderModel;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BetChangeStatusListener
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
     * @param  BetChangeStatusEvent  $event
     * @return void
     */
    public function handle(BetChangeStatusEvent $event)
    {
        \Order::betStatusChanged($event->bet->order, $event->bet->status);
    }
}
