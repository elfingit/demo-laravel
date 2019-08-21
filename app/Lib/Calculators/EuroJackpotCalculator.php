<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-06
 * Time: 09:04
 */
namespace App\Lib\Calculators;

use App\Lib\Utils;
use App\Model\BetTicket as BetTicketModel;
use App\Model\BrandResult as BrandResultModel;
use Illuminate\Support\Collection;

class EuroJackpotCalculator extends AbstractCalculator
{
    protected function checkTicket(BetTicketModel $ticket, BrandResultModel $result)
    {
        $line = $ticket->line;
        $line = array_map([Utils::class, 'toInt'], $line);
        sort( $line, SORT_NUMERIC );

        $line_result = $result->results->main_result;
        $line_result = array_map([Utils::class, 'toInt'], $line_result);
        sort( $line_result, SORT_NUMERIC );

        $diff = array_diff( $line_result, $line );

        //5 numbers 2 euronumbers
        if ( count( $diff ) == 0 && $this->checkEuroNumber( $result, $ticket ) === true ) {
            \Ticket::markTicketAsWin( $ticket, 31757979 );

            return self::WIN;
        //5 numbers 1 euronumber
        } elseif ( count( $diff ) == 0 && $this->checkEuroNumber( $result, $ticket ) === 1 ) {
            \Ticket::markTicketAsWin( $ticket, 994791 );

            return self::WIN;
        //5 numbers
        } elseif ( count( $diff ) == 0 && $this->checkEuroNumber( $result, $ticket ) === 2 ) {
            \Ticket::markTicketAsWin( $ticket, 66362 );

            return self::WIN;
        //4 numbers + 2 euronumbers
        } elseif ( count( $diff ) == 1 && $this->checkEuroNumber( $result, $ticket ) === true ) {
            \Ticket::markTicketAsWin( $ticket, 2571 );

            return self::WIN;
        //4 numbers + 1 euronumber
        } elseif ( count( $diff ) == 1 && $this->checkEuroNumber( $result, $ticket ) === 1 ) {
            \Ticket::markTicketAsWin( $ticket, 160 );

            return self::WIN;
        //4 numbers
        } elseif ( count( $diff ) == 1 && $this->checkEuroNumber( $result, $ticket ) === 2 ) {
            \Ticket::markTicketAsWin( $ticket, 76 );

            return self::WIN;
        //3 numbers + 2 euronumbers
        } elseif ( count( $diff ) == 2 && $this->checkEuroNumber( $result, $ticket ) === true ) {
            \Ticket::markTicketAsWin( $ticket, 35 );

            return self::WIN;
        //2 numbers + 2 euronumbers
        } elseif ( count( $diff ) == 3 && $this->checkEuroNumber( $result, $ticket ) === true ) {
            \Ticket::markTicketAsWin( $ticket, 22 );

            return self::WIN;
        //3 numbers + 1 euronumber
        } elseif ( count( $diff ) == 2 && $this->checkEuroNumber( $result, $ticket ) === 1 ) {
            \Ticket::markTicketAsWin( $ticket, 14 );

            return self::WIN;
        //3 numbers
        } elseif ( count( $diff ) == 2 && $this->checkEuroNumber( $result, $ticket ) === 2 ) {
            \Ticket::markTicketAsWin( $ticket, 10.6 );

            return self::WIN;
        //1 number + 2 euronumbers
        } elseif ( count( $diff ) == 4 && $this->checkEuroNumber( $result, $ticket ) === true ) {
            \Ticket::markTicketAsWin( $ticket, 8.1 );

            return self::WIN;
        //2 numbers + 1 euronumber
        } elseif ( count( $diff ) == 3 && $this->checkEuroNumber( $result, $ticket ) === 1 ) {
            \Ticket::markTicketAsWin( $ticket, 5.2 );

            return self::WIN;
        }

        \Ticket::markTicketAsPlayed( $ticket);

        return self::NOT_WIN;
    }

    protected function checkEuroNumber(BrandResultModel $result, BetTicketModel $ticket)
    {
        $numbers_result = $result->results->extra_ball;
        $numbers = $ticket->extra_balls;

        sort($numbers_result, SORT_NUMERIC);
        sort($numbers, SORT_NUMERIC);

        $diff = array_diff($numbers_result, $numbers);

        if (count($diff) == 0) {
            return true;
        }

        return count($diff);
    }
}
