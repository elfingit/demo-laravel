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
                $ticketResult = $this->checkTicket($ticket, $result);

                if ($ticketResult == self::WIN) {
                    $betWin = true;
                }
            }

            if ($betWin === true) {
                \Bet::markAsWin($bet);
            } else {
                \Bet::markAsPlayed($bet);
            }

            $this->checkSpiel77($bet, $result);
            $this->checkSuper6($bet, $result);

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

    protected function checkSpiel77(BetModel $bet, BrandResultModel $result)
    {
        $ticket = $bet->tickets[0];

        $gameIsExists = false;

        foreach ($ticket->extra_games as $game) {
            if ($game['system_name'] == 'speil77') {
                $gameIsExists = true;
            }
        }

        if (!$gameIsExists) {
            return;
        }

        if ($bet->additional_data && $bet->additional_data->ticket_number) {
            $spiel77 = (string)$result->results->additional_games->spiel77;

            $count = 0;

            $numbersObject = $this->convertArrayToObject($bet->additional_data->ticket_number);

            for($i = 7; $i >= 1; $i--) {
                $n1 = intval($numbersObject->{'n'. $i});
                $n2 = intval(mb_substr($spiel77, $i - 1, 1));

                if ($n1 === $n2) {
                    $count++;
                }
            }

            if ($count > 0) {
                $amount = $this->getSpiel77Amount($count);
                $aData = $bet->additional_data;
                $aData->spiel77 = $amount;
                $bet->additional_data = $aData;
                \Bet::markAsWin($bet);
            }
        }
    }

    protected function checkSuper6(BetModel $bet, BrandResultModel $result)
    {
        $ticket = $bet->tickets[0];

        $gameIsExists = false;

        foreach ($ticket->extra_games as $game) {
            if ($game['system_name'] == 'super6') {
                $gameIsExists = true;
            }
        }

        if (!$gameIsExists) {
            return;
        }

        if ($bet->additional_data && $bet->additional_data->ticket_number) {
            $super6 = (string) $result->results->additional_games->super6;
            $count = 0;

            $numbersObject = $this->convertArrayToObject($bet->additional_data->ticket_number);

            for($i = 7; $i >= 2; $i--) {
                $n1 = intval($numbersObject->{'n'. $i});
                $n2 = intval(mb_substr($super6, $i - 2, 1));

                if ($n1 === $n2) {
                    $count++;
                }
            }

            if ($count > 0) {
                $amount = $this->getSuper6Amount($count);
                $adata = $bet->additional_data;
                $adata->super6 = $amount;
                $bet->additional_data = $adata;

                \Bet::markAsWin($bet);
            }
        }
    }

    protected function convertArrayToObject(array $data)
    {
        $obj = new \stdClass();

        foreach ($data as $value) {
            $vars = get_object_vars($value);
            foreach ($vars as $k => $v) {
                $obj->{$k} = $v;
            }
        }

        return $obj;
    }

    protected function getSpiel77Amount($numbers)
    {
        switch ($numbers) {
            case 7:
                return 877777;
            case 6:
                return 77777;
            case 5:
                return 7777;
            case 4:
                return 777;
            case 3:
                return 77;
            case 2:
                return 17;
            case 1:
                return 5;
        }
    }

    protected function getSuper6Amount($numbers)
    {
        switch ($numbers) {
            case 6:
                return 100000;
            case 5:
                return 6666;
            case 4:
                return 666;
            case 3:
                return 66;
            case 2:
                return 6;
            case 1:
                return 2.5;

        }
    }

}
