<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-05
 * Time: 09:55
 */
namespace App\Services;

use App\Model\BetTicket as BetTicketModel;
use App\Services\Contracts\TicketServiceContract;

class TicketService implements TicketServiceContract
{
    public function markTicketAsPlayed( BetTicketModel $ticket )
    {
        $ticket->status = BetTicketModel::STATUS_PLAYED;
        $ticket->save();
    }

    public function markTicketAsWin( BetTicketModel $ticket, $win_amount )
    {
        $ticket->status = BetTicketModel::STATUS_WIN;
        $ticket->win_amount = $win_amount;
        $ticket->save();
    }
}
