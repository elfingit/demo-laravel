<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-06
 * Time: 10:41
 */
namespace App\Lib\Calculators;

use App\Model\BetTicket as BetTicketModel;
use App\Model\BrandResult as BrandResultModel;
use Illuminate\Support\Collection;

class MegaMillionsCalculator extends AbstractCalculator
{
    protected function checkTicket(BetTicketModel $ticket, BrandResultModel $result)
    {
        $line = $ticket->line;
        sort($line, SORT_NUMERIC);

        $line_result = $result->results->main_result;
        sort($line_result, SORT_NUMERIC);

        $diff = array_diff($line_result, $line);

        //Megaball
        if (count($diff) == 5 && $this->checkMegaBall($result, $ticket) === true) {
            \Ticket::markTicketAsWin( $ticket, $this->getWinAmount( $ticket, $result, 1.8 ) );

            return self::WIN;
        //1 number + megaball
        } elseif (count($diff) == 4 && $this->checkMegaBall($result, $ticket) === true) {
            \Ticket::markTicketAsWin( $ticket, $this->getWinAmount( $ticket, $result, 3.6 ) );

            return self::WIN;
        //2 numbers + megaball
        } elseif (count($diff) == 3 && $this->checkMegaBall($result, $ticket) === true) {
            \Ticket::markTicketAsWin( $ticket, $this->getWinAmount( $ticket, $result, 8.9 ) );

            return self::WIN;
        //3 numbers
        } elseif (count($diff) == 2 && $this->checkMegaBall($result, $ticket) === false) {
            \Ticket::markTicketAsWin( $ticket, $this->getWinAmount( $ticket, $result, 8.9 ) );

            return self::WIN;
        //3 numbers + megaball
        } elseif (count($diff) == 2 && $this->checkMegaBall($result, $ticket) === true) {
            \Ticket::markTicketAsWin( $ticket, $this->getWinAmount( $ticket, $result, 179.7 ) );

            return self::WIN;
        //4 numbers
        } elseif (count($diff) == 1 && $this->checkMegaBall($result, $ticket) === false) {
            \Ticket::markTicketAsWin( $ticket, $this->getWinAmount( $ticket, $result, 449.25 ) );

            return self::WIN;
        //4 numbers + megaball
        } elseif (count($diff) == 1 && $this->checkMegaBall($result, $ticket) === true) {
            \Ticket::markTicketAsWin( $ticket, $this->getWinAmount( $ticket, $result, 449.25 ) );

            return self::WIN;
        //5 numbers
        } elseif (count($diff) == 0 && $this->checkMegaBall($result, $ticket) === false) {
            \Ticket::markTicketAsWin( $ticket, $this->getWinAmount( $ticket, $result, 898510 ) );

            return self::WIN;
        //5 numbers + megaball
        } elseif (count($diff) == 0 && $this->checkMegaBall($result, $ticket) === true) {
            \Ticket::markTicketAsWin( $ticket, $this->getWinAmount( $ticket, $result, 44503200.30 ) );

            return self::WIN;
        } else {
            \Ticket::markTicketAsPlayed( $ticket );

            return self::NOT_WIN;
        }
    }

    protected function checkMegaBall(BrandResultModel $result, BetTicketModel $ticket)
    {
        $megaBallExpected = intval($ticket->extra_balls[0]);
        $megaBallActual = intval($result->results->extra_ball);

        return $megaBallExpected === $megaBallActual;
    }

    protected function getWinAmount($ticket, $result, $amount)
    {
        if (!empty($ticket->extra_games) && $ticket->extra_games[0]['system_name'] == 'megaplier') {
            if ($result->results->additional_games) {
                $coof = intval($result->results->additional_games->megaplier);

                $amount = $amount * $coof;
            }
        }
        return $amount;
    }

}
