<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-15
 * Time: 14:19
 */

namespace App\Services\Contracts;


use App\Model\User as UserModel;
use App\Model\Bet as BetModel;
use App\Model\UserWithdrawableBalance as UserWithdrawableBalanceModel;
use App\Model\UserWithdrawableBalanceTransaction as UserWithdrawableBalanceTransactionModel;

interface UserWithdrawableBalanceServiceContract
{
    public function addWin($amount, BetModel $bet, UserModel $user, $reason = null);
    public function addPending($amount, BetModel $bet, UserModel $user, $reason = null);
    public function addAvailable($amount, BetModel $bet, UserModel $user, $reason = null);
    public function moveFromPendingToAvailable(UserWithdrawableBalanceTransactionModel $transaction);
    public function charge(UserWithdrawableBalanceModel $balance, $amount, UserModel $user);
    public function getTransactions();
}
