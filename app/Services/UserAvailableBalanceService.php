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
use App\Services\Contracts\UserAvailableBalanceServiceContract;
use Illuminate\Http\Request;

class UserAvailableBalanceService implements UserAvailableBalanceServiceContract
{
	public function list( Request $request, UserModel $user )
	{
		if ($user->available_balance) {
			//TODO return transactions
		}

		return null;
	}

	public function add( $amount, $reason, UserModel $user )
	{
		if (is_null($user->available_balance)) {
			$this->createBalance($amount, $reason, $user);
		} else {
			$this->updateBalance($amount, $reason, $user);
		}

		return $user;

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

		\DB::commit();
	}
}