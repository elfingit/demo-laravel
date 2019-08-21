<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-01
 * Time: 10:41
 */
namespace App\Lib\Calculators;

use App\Lib\Utils;
use App\Model\BetTicket as BetTicketModel;
use App\Model\BrandResult as BrandResultModel;
use Illuminate\Support\Collection;

class PowerBallCalculator extends AbstractCalculator
{
    protected function checkTicket(BetTicketModel $ticket, BrandResultModel $result)
    {
        $line = $ticket->line;
        $line = array_map([Utils::class, 'toInt'], $line);
        sort($line, SORT_NUMERIC);

        $line_result = $result->results->main_result;
        $line_result = array_map([Utils::class, 'toInt'], $line_result);
        sort($line_result, SORT_NUMERIC);

        $diff = array_diff($line_result, $line);

        //Line absolutely not match
        if (count($diff) == 5 && $this->checkPowerBall($result, $ticket) === false) {
            \Ticket::markTicketAsPlayed( $ticket );

            return self::NOT_WIN;
        //Power ball win
        } elseif (count($diff) == 5 && $this->checkPowerBall($result, $ticket) === true) {
            $win_amount = $this->getWinAmount($ticket, $result, 3.30);
            \Ticket::markTicketAsWin( $ticket, $win_amount );

            return self::WIN;
        //Power ball and one number wins
        } elseif (count($diff) == 4 && $this->checkPowerBall($result, $ticket) === true) {
            $win_amount = $this->getWinAmount($ticket, $result, 3.30);
            \Ticket::markTicketAsWin( $ticket, $win_amount );

            return self::WIN;
        //Power ball and 2 numbers
        } elseif (count($diff) == 3 && $this->checkPowerBall($result, $ticket) === false) {
            $win_amount = $this->getWinAmount($ticket, $result, 6);
            \Ticket::markTicketAsWin( $ticket, $win_amount );

            return self::WIN;
        //Power ball and 3 numbers
        } elseif (count($diff) == 2 && $this->checkPowerBall($result, $ticket) === true) {
            $win_amount = $this->getWinAmount($ticket, $result, 84);
            \Ticket::markTicketAsWin( $ticket, $win_amount );

            return self::WIN;
        //Only 3 numbers
        } elseif (count($diff) == 2 && $this->checkPowerBall($result, $ticket) === false) {
            $win_amount = $this->getWinAmount($ticket, $result, 6);
            \Ticket::markTicketAsWin( $ticket, $win_amount );

            return self::WIN;
        //Only 4 numbers
        } elseif (count($diff) == 1 && $this->checkPowerBall($result, $ticket) === false) {
            $win_amount = $this->getWinAmount($ticket, $result, 84);
            \Ticket::markTicketAsWin( $ticket, $win_amount );

            return self::WIN;
        //Power ball and 4 numbers
        } elseif (count($diff) == 1 && $this->checkPowerBall($result, $ticket) === true) {
            $win_amount = $this->getWinAmount($ticket, $result, 40000);
            \Ticket::markTicketAsWin( $ticket, $win_amount );

            return self::WIN;
        //Power ball and 5 numbers
        } elseif (count($diff) == 0 && $this->checkPowerBall($result, $ticket) === true) {
            $win_amount = $this->getWinAmount($ticket, $result, 31000000);
            \Ticket::markTicketAsWin( $ticket, $win_amount );

            return self::WIN;
        //Only 5 numbers
        } elseif (count($diff) == 0 && $this->checkPowerBall($result, $ticket) === false) {
            $win_amount = $this->getWinAmount($ticket, $result, 834000);
            \Ticket::markTicketAsWin( $ticket, $win_amount );

            return self::WIN;
        }
    }

    protected function getWinAmount($ticket, $result, $amount)
    {
        if (!empty($ticket->extra_games) && $ticket->extra_games[0]['system_name'] == 'powerplay') {
            if ($result->results->additional_games) {
                $coof = intval($result->results->additional_games->megaplier);

                $amount = $amount * $coof;
            }
        }
        return $amount;
    }

    protected function checkPowerBall(BrandResultModel $result, BetTicketModel $ticket )
    {
        $powerBallExpected = intval($ticket->extra_balls[0]);
        $powerBallActual = intval($result->results->extra_ball);

        return $powerBallActual === $powerBallExpected;
    }
}
