<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-15
 * Time: 14:23
 */

namespace App\Services;


use App\Model\Bet as BetModel;
use App\Model\User as UserModel;
use App\Model\UserTransaction as UserTransactionModel;
use App\Model\UserWithdrawableBalance as UserWithdrawableBalanceModel;
use App\Model\UserWithdrawableBalanceTransaction as UserWithdrawableBalanceTransactionModel;
use App\Services\Contracts\UserWithdrawableBalanceServiceContract;

class UserWithdrawableBalanceService implements UserWithdrawableBalanceServiceContract
{
    public function addWin( $amount, BetModel $bet, UserModel $user, $reason = null )
    {
        if ($user->is_authorized == true) {
            $this->addAvailable($amount, $bet, $user, $reason);
        } else {
            $this->addPending($amount, $bet, $user, $reason);
        }
    }

    public function addAvailable( $amount, BetModel $bet, UserModel $user, $reason = null )
    {
        $this->add(
            $amount,
            $bet,
            $user,
            UserWithdrawableBalanceTransactionModel::STATUS_AUTH,
            $reason);
    }

    public function addPending( $amount, BetModel $bet, UserModel $user, $reason = null )
    {
        $this->add(
            $amount,
            $bet,
            $user,
            UserWithdrawableBalanceTransactionModel::STATUS_PENDING,
            $reason);
    }

    public function moveFromPendingToAvailable( UserWithdrawableBalanceTransactionModel $transaction )
    {
        \DB::beginTransaction();
        $balance = $transaction->balance;
        $balance->lockForUpdate();

        $balance->pending_amount = floatval($balance->pending_amount) - floatval($transaction->amount);
        $balance->available_amount = floatval($balance->available_amount) + floatval($transaction->amount);
        $balance->save();

        $transaction->status = UserWithdrawableBalanceTransactionModel::STATUS_PAYOUT_PENDING;
        $transaction->save();

        \DB::commit();
    }


    public function charge( UserWithdrawableBalanceModel $balance, $amount, UserModel $user )
    {
        // TODO: Implement charge() method.
    }

    public function getTransactions()
    {
        $query = UserWithdrawableBalanceTransactionModel::query();

        $query->orderBy('updated_at', 'desc');

        return $query->paginate(25);
    }

    protected function add($amount, BetModel $bet, UserModel $user, $status, $reason = null)
    {
        $balance = $user->withdrawable_balance;

        if (is_null($balance)) {
            $balance = $this->createBalance($user);
        }

        \DB::beginTransaction();
        $balance->lockForUpdate();

        if ($status == UserWithdrawableBalanceTransactionModel::STATUS_PENDING) {
            $balance->pending_amount = $balance->pending_amount + $amount;
        } elseif ($status == UserWithdrawableBalanceTransactionModel::STATUS_AUTH) {
            $balance->available_amount = $balance->available_amount + $amount;
        }


        $balance->save();

        $wTransaction = new UserWithdrawableBalanceTransactionModel([
            'transaction_id'    => \Str::random(4).'-'.\Str::random(),
            'amount'            => $amount,
            'balance_id'        => $balance->id,
            'bet_id'            => $bet->id,
            'status'            => $status,
            'notes'             => $reason
        ]);

        $wTransaction->save();

        $transaction = new UserTransactionModel([
            'user_id'           => $user->id,
            'transaction_id'    => $wTransaction->id,
            'transaction_type'  => UserWithdrawableBalanceTransactionModel::class
        ]);

        $transaction->save();

        \DB::commit();
    }

    protected function createBalance(UserModel $user)
    {
        $tableName = (new UserWithdrawableBalanceModel())->getTable();

        \DB::beginTransaction();
        \DB::raw('LOCK TABLE ' . $tableName . ' IN ACCESS EXCLUSIVE');

        $model = new UserWithdrawableBalanceModel([
            'available_amount' => 0,
            'pending_amount'   => 0
        ]);

        $user->withdrawable_balance()->save($model);
        \DB::commit();

        return $model;
    }

}
