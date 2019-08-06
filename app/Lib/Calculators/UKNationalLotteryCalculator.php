<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-06
 * Time: 12:24
 */
namespace App\Lib\Calculators;

use App\Model\BetTicket as BetTicketModel;
use App\Model\BrandResult as BrandResultModel;
use Illuminate\Support\Collection;

class UKNationalLotteryCalculator extends AbstractCalculator
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
        }
    }

    protected function checkTicket(BetTicketModel $ticket, BrandResultModel $result)
    {
        $line = $ticket->line;
        sort( $line, SORT_NUMERIC );

        $line_result = $result->results->main_result;
        sort( $line_result, SORT_NUMERIC );

        $diff = array_diff( $line_result, $line );

        //2 numbers
        if (count($diff) == 4) {
            \Ticket::markTicketAsWin( $ticket, 2.18 );

            return self::WIN;
        //3 numbers
        } elseif (count($diff) == 3) {
            \Ticket::markTicketAsWin( $ticket, 27.30 );

            return self::WIN;
        //4 numbers
        } elseif (count($diff) == 2) {
            \Ticket::markTicketAsWin( $ticket, 152.87 );

            return self::WIN;
        //5 numbers
        } elseif (count($diff) == 1) {
            \Ticket::markTicketAsWin( $ticket, 1911.34 );

            return self::WIN;
        }

        $tmp_line = $this->makeBonusBallLine($result, $line);

        $tmp_diff = array_diff($line_result, $tmp_line);
        //5 numbers + bonus ball
        if (count($tmp_diff) == 0) {
            \Ticket::markTicketAsWin( $ticket, 1092191.92 );

            return self::WIN;
        }

        if (count($diff) == 0) {
            \Ticket::markTicketAsWin( $ticket, 10919274.23 );

            return self::WIN;
        }

        \Ticket::markTicketAsPlayed($ticket);

        return self::NOT_WIN;
    }

    protected function makeBonusBallLine(BrandResultModel $result, $line)
    {
        $line[count($line) - 1] = $result->results->extra_ball;
        sort($line, SORT_NUMERIC);

        return $line;
    }
}
