<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-17
 * Time: 10:38
 */

namespace App\Services;

use App\Model\User as UserModel;
use App\Model\UserAvailableBalance as UserAvailableBalanceModel;
use App\Model\UserAvailableBalanceTransaction as UserAvailableBalanceTransactionModel;
use App\Model\UserTransaction as UserTransactionModel;
use App\Services\Contracts\UserAvailableBalanceServiceContract;
use App\Services\Exceptions\InsufficientAvailableBalanceException;

class UserAvailableBalanceService implements UserAvailableBalanceServiceContract
{
	public function add( $amount, $reason, UserModel $user )
	{
		$transaction = null;

		if (is_null($user->available_balance)) {
			$transaction = $this->createBalance($amount, $reason, $user);
		} else {
			$transaction = $this->updateBalance($amount, $reason, $user);
		}

		return $transaction;

	}

    public function charge( $amount, UserModel $user )
    {
        if (is_null($user->available_balance)) {
            \ApiLogger::warn('Insufficient user balance. ' . $user->id . '; Balance not exists',
                'UserAvailableBalanceService');
            throw new InsufficientAvailableBalanceException('Insufficient user balance.');
        }

        \DB::beginTransaction();
        $user->available_balance->lockForUpdate();

        if ($user->available_balance->amount >= $amount) {

            $user->available_balance->amount = $user->available_balance->amount - $amount;
            $user->available_balance->save();

            $transaction = new UserAvailableBalanceTransactionModel([
                'amount'    => -$amount,
                'transaction_id' => \Str::random(4).'-'.\Str::random(),
                'notes' => 'Order'
            ]);


            $user->available_balance->transactions()->save($transaction);

            \DB::commit();
            return $transaction;
        } else {
            \DB::rollBack();
            \ApiLogger::warn('Insufficient user balance. ' . $user->id, ['UserAvailableBalanceService']);
            throw new InsufficientAvailableBalanceException('Insufficient user balance.');
        }
    }

    protected function updateBalance($amount, $reason, UserModel $user)
	{
		\DB::beginTransaction();
		$user->available_balance->lockForUpdate();
		$user->available_balance->amount = $user->available_balance->amount + $amount;
		$user->available_balance->save();

		$transaction = new UserAvailableBalanceTransactionModel([
			'amount'    => $amount,
			'transaction_id' => \Str::random(4).'-'.\Str::random(),
			'notes' => $reason
		]);


		$user->available_balance->transactions()->save($transaction);

        $uTransaction = new UserTransactionModel([
            'user_id'   => $user->id,
            'transaction_id'    => $transaction->id,
            'transaction_type'  => UserAvailableBalanceTransactionModel::class
        ]);

        $uTransaction->save();
		\DB::commit();

		return $uTransaction;

	}

	protected function createBalance($amount, $reason, UserModel $user)
	{
		$tableName = (new UserAvailableBalanceModel())->getTable();

		\DB::beginTransaction();
		\DB::raw('LOCK TABLE ' . $tableName . ' IN ACCESS EXCLUSIVE');

		$model = new UserAvailableBalanceModel([
			'amount' => $amount
		]);

		$user->available_balance()->save($model);

		$transaction = new UserAvailableBalanceTransactionModel([
			'amount'    => $amount,
			'transaction_id' => \Str::random(4).'-'.\Str::random(),
			'notes' => $reason
		]);

		$model->transactions()->save($transaction);

		$uTransaction = new UserTransactionModel([
		    'user_id'   => $user->id,
            'transaction_id'    => $transaction->id,
            'transaction_type'  => UserAvailableBalanceTransactionModel::class
        ]);

		$uTransaction->save();

		\DB::commit();

		return $uTransaction;
	}
}
