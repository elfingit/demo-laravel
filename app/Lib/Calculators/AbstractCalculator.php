<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-05
 * Time: 09:24
 */
namespace App\Lib\Calculators;

use App\Lib\Loggers\WinCheckLogger;
use App\Model\Bet as BetModel;
use App\Model\BetTicket as BetTicketModel;
use App\Model\BrandResult as BrandResultModel;
use Illuminate\Support\Collection;

abstract  class AbstractCalculator implements CalculatorContract
{
    const WIN = 1;
    const NOT_WIN = 0;

    /**
     * @var \Monolog\Logger
     */
    protected $logger;

    public function __construct()
    {
        $this->logger = WinCheckLogger::getLogger();
    }

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

            if ($bet->status == BetModel::STATUS_WIN) {
                \UserWithdrawabalBalance::addWin($bet->win_amount, $bet, $bet->user, 'Bet win');
            }
        }
    }

    abstract protected function checkTicket(BetTicketModel $ticket, BrandResultModel $result);
}
