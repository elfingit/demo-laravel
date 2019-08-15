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
    public function addPending( $amount, BetModel $bet, UserModel $user, $reason = null )
    {
        $balance = $user->withdrawable_balance;

        if (is_null($balance)) {
            $balance = $this->createBalance($user);
        }

        \DB::beginTransaction();
        $balance->lockForUpdate();
        $balance->pending_amount = $balance->pending_amount + $amount;
        $balance->save();

        $wTransaction = new UserWithdrawableBalanceTransactionModel([
            'transaction_id'    => \Str::random(4).'-'.\Str::random(),
            'amount'            => $amount,
            'balance_id'        => $balance->id,
            'bet_id'            => $bet->id,
            'status'            => UserWithdrawableBalanceTransactionModel::STATUS_PENDING
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

    public function moveFromPendingToAvailable( UserWithdrawableBalanceModel $balance, $amount )
    {
        // TODO: Implement moveFromPendingToAvailable() method.
    }

    public function charge( UserWithdrawableBalanceModel $balance, $amount, UserModel $user )
    {
        // TODO: Implement charge() method.
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
