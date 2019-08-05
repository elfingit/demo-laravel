<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-01
 * Time: 10:41
 */
namespace App\Lib\Calculators;

use App\Model\BetTicket as BetTicketModel;
use App\Model\BrandResult as BrandResultModel;
use Illuminate\Support\Collection;

class PowerBallCalculator extends AbstractCalculator
{
    public function check( Collection $bets, BrandResultModel $result)
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
        }
    }

    protected function checkTicket(BetTicketModel $ticket, BrandResultModel $result)
    {
        $line = $ticket->line;
        sort($line, SORT_NUMERIC);

        $line_result = $result->results->main_result;
        sort($line_result, SORT_NUMERIC);

        $diff = array_diff($line_result, $line);

        //Line absolutely not match
        if (count($diff) == 5 && $this->checkPowerBall($result, $ticket) === false) {
            \Ticket::markTicketAsPlayed( $ticket );

            return self::NOT_WIN;
        //Power ball win
        } elseif (count($diff) == 5 && $this->checkPowerBall($result, $ticket) === true) {
            \Ticket::markTicketAsWin( $ticket, 3.30 );

            return self::WIN;
        //Power ball and one number wins
        } elseif (count($diff) == 4 && $this->checkPowerBall($result, $ticket) === true) {
            \Ticket::markTicketAsWin( $ticket, 3.30 );

            return self::WIN;
        //Power ball and 2 numbers
        } elseif (count($diff) == 3 && $this->checkPowerBall($result, $ticket) === false) {
            \Ticket::markTicketAsWin( $ticket, 6 );

            return self::WIN;
        //Power ball and 3 numbers
        } elseif (count($diff) == 2 && $this->checkPowerBall($result, $ticket) === true) {
            \Ticket::markTicketAsWin( $ticket, 84 );

            return self::WIN;
        //Only 3 numbers
        } elseif (count($diff) == 2 && $this->checkPowerBall($result, $ticket) === false) {
            \Ticket::markTicketAsWin( $ticket, 6 );

            return self::WIN;
        //Only 4 numbers
        } elseif (count($diff) == 1 && $this->checkPowerBall($result, $ticket) === false) {
            \Ticket::markTicketAsWin( $ticket, 84 );

            return self::WIN;
        //Power ball and 4 numbers
        } elseif (count($diff) == 1 && $this->checkPowerBall($result, $ticket) === true) {
            \Ticket::markTicketAsWin( $ticket, 40000 );

            return self::WIN;
        //Power ball and 5 numbers
        } elseif (count($diff) == 0 && $this->checkPowerBall($result, $ticket) === true) {
            \Ticket::markTicketAsWin( $ticket, 31000000 );

            return self::WIN;
        //Only 5 numbers
        } elseif (count($diff) == 0 && $this->checkPowerBall($result, $ticket) === false) {
            \Ticket::markTicketAsWin( $ticket, 834000 );

            return self::WIN;
        }
    }

    protected function checkPowerBall(BrandResultModel $result, BetTicketModel $ticket )
    {
        $powerBallExpected = intval($ticket->extra_balls[0]);
        $powerBallActual = intval($result->results->extra_ball);

        return $powerBallActual === $powerBallExpected;
    }
}
