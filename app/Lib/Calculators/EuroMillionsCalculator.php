<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-05
 * Time: 14:26
 */
namespace App\Lib\Calculators;

use App\Model\BetTicket as BetTicketModel;
use App\Model\BrandResult as BrandResultModel;
use Illuminate\Support\Collection;

class EuroMillionsCalculator extends AbstractCalculator
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
        //Match 2
        if (count($diff) == 3 && $this->checkLuckyStar($result, $ticket) === false) {
            \Ticket::markTicketAsWin( $ticket, 4.17 );

            return self::WIN;
        //Match 2 + 1 lucky star
        } elseif (count($diff) == 3 && $this->checkLuckyStar($result, $ticket) === 1) {
            \Ticket::markTicketAsWin( $ticket, 8.07 );

            return self::WIN;
        //Match 1 + 2 lucky stars
        } elseif (count($diff) == 4 && $this->checkLuckyStar($result, $ticket) === 2) {
            \Ticket::markTicketAsWin( $ticket, 10.69 );

            return self::WIN;
        //Match 3
        } elseif (count($diff) == 2 && $this->checkLuckyStar($result, $ticket) === false) {
            \Ticket::markTicketAsWin( $ticket, 12.20 );

            return self::WIN;
        //Match 3 + 1 lucky star
        } elseif (count($diff) == 2 && $this->checkLuckyStar($result, $ticket) === 1) {
            \Ticket::markTicketAsWin( $ticket, 14.66 );

            return self::WIN;
        //Match 2 + 2 lucky stars
        } elseif (count($diff) == 3 && $this->checkLuckyStar($result, $ticket) === 2) {
            \Ticket::markTicketAsWin( $ticket, 19.98 );

            return self::WIN;
        //Match 4
        } elseif (count($diff) == 1 && $this->checkLuckyStar($result, $ticket) === false) {
            \Ticket::markTicketAsWin( $ticket, 89.32 );

            return self::WIN;
        //Match 3 + 2 lucky star
        } elseif (count($diff) == 2 && $this->checkLuckyStar($result, $ticket) === 2) {
            \Ticket::markTicketAsWin( $ticket, 79.71 );

            return self::WIN;
        //Match 4 + 1 lucky star
        } elseif (count($diff) == 1 && $this->checkLuckyStar($result, $ticket) === 1) {
            \Ticket::markTicketAsWin( $ticket, 198.01 );

            return self::WIN;
        //Match 4 + 2 lucky stars
        } elseif (count($diff) == 1 && $this->checkLuckyStar($result, $ticket) === 2) {
            \Ticket::markTicketAsWin( $ticket, 4298.29 );

            return self::WIN;
        //Match 5
        } elseif (count($diff) == 0 && $this->checkLuckyStar($result, $ticket) === false) {
            \Ticket::markTicketAsWin( $ticket, 76198.92 );

            return self::WIN;
        //Match 5 + 1 lucky star
        } elseif (count($diff) == 0 && $this->checkLuckyStar($result, $ticket) === 1) {
            \Ticket::markTicketAsWin( $ticket, 440951.13 );

            return self::WIN;
        //Match 5 + 2 lucky stars
        } elseif (count($diff) == 0 && $this->checkLuckyStar($result, $ticket) === 2) {
            \Ticket::markTicketAsWin( $ticket, 50177266.94 );

            return self::WIN;
        }
    }

    protected function checkLuckyStar(BrandResultModel $result, BetTicketModel $ticket)
    {
        $stars_result = $result->results->extra_ball;
        $stars = $ticket->extra_balls;

        sort($stars_result, SORT_NUMERIC);
        sort($stars, SORT_NUMERIC);

        $diff = array_diff($stars_result, $stars);

        if (count($diff) == 0) {
            return false;
        }

        return count($diff);
    }
}
