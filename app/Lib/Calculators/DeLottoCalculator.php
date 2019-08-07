<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-06
 * Time: 12:36
 */

namespace App\Lib\Calculators;


use App\Model\Bet as BetModel;
use App\Model\BetTicket as BetTicketModel;
use App\Model\BrandResult as BrandResultModel;
use Illuminate\Support\Collection;

class DeLottoCalculator extends AbstractCalculator
{
    public function check( Collection $bets, BrandResultModel $result )
    {
        foreach ($bets as $bet) {
            $tickets = $bet->wait_tickets;

            $betWin = false;

            foreach ($tickets as $ticket) {
                $result = $this->checkTicket($ticket, $result);

                if ($result == self::WIN) {
                    $betWin = true;
                }
            }

            if ($betWin === true) {
                \Bet::markAsWin($bet);
            } else {
                \Bet::markAsPlayed($bet);
            }

            //TODO check spiel77 and super6

            $this->checkSpiel77($bet);
        }
    }

    protected function checkTicket( BetTicketModel $ticket, BrandResultModel $result )
    {
        $line = $ticket->line;
        sort( $line, SORT_NUMERIC );

        $line_result = $result->results->main_result;
        sort( $line_result, SORT_NUMERIC );

        $diff = array_diff( $line_result, $line );
        //2 numbers + superball
        if (count($diff) == 4 && $this->checkSuperBall($result, $ticket) === true) {
            \Ticket::markTicketAsWin($ticket, 4.50);

            return self::WIN;
        } elseif (count($diff) == 3 && $this->checkSuperBall($result, $ticket) === false) {
            \Ticket::markTicketAsWin($ticket, 10.50);

            return self::WIN;
        //3 numbers + superball
        } elseif (count($diff) == 3 && $this->checkSuperBall($result, $ticket) === true) {
            \Ticket::markTicketAsWin($ticket, 19.80);

            return self::WIN;
        //4 numbers
        } elseif (count($diff) == 2 && $this->checkSuperBall($result, $ticket) === false) {
            \Ticket::markTicketAsWin($ticket, 42.70);

            return self::WIN;
        //4 numbers + superball
        } elseif (count($diff) == 2 && $this->checkSuperBall($result, $ticket) === true) {
            \Ticket::markTicketAsWin($ticket, 201.50);

            return self::WIN;
        //5 numbers
        } elseif (count($diff) == 1 && $this->checkSuperBall($result, $ticket) === false) {
            \Ticket::markTicketAsWin($ticket, 3995.70);

            return self::WIN;
        //5 numbers + superball
        } elseif (count($diff) == 1 && $this->checkSuperBall($result, $ticket) === true) {
            \Ticket::markTicketAsWin($ticket, 10745.80);

            return self::WIN;
        //6 numbers
        } elseif (count($diff) == 0 && $this->checkSuperBall($result, $ticket) === false) {
            \Ticket::markTicketAsWin($ticket, 538983.50);

            return self::WIN;
        //6 numbers + superball
        } elseif (count($diff) == 0 && $this->checkSuperBall($result, $ticket) === true) {
            \Ticket::markTicketAsWin($ticket, 14011119.30);

            return self::WIN;
        }

        \Ticket::markTicketAsPlayed($ticket);

        return self::NOT_WIN;
    }

    protected function checkSuperBall(BrandResultModel $result, BetTicketModel $ticket )
    {
        $powerBallExpected = intval($ticket->extra_balls[0]);
        $powerBallActual = intval($result->results->extra_ball);

        return $powerBallActual === $powerBallExpected;
    }

    protected function checkSpiel77(BetModel $bet)
    {

    }
}
