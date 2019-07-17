<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-17
 * Time: 10:38
 */

namespace App\Services;

use App\Model\User as UserModel;
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
}