<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-05
 * Time: 09:54
 */
namespace App\Services\Contracts;

use App\Model\BetTicket as BetTicketModel;

interface TicketServiceContract
{
    public function markTicketAsPlayed(BetTicketModel $ticket);
    public function markTicketAsWin(BetTicketModel $ticket, $win_amount);
}
