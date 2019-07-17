<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-17
 * Time: 10:47
 */

namespace App\Facades;

use App\Services\Contracts\UserAvailableBalanceServiceContract;
use Illuminate\Support\Facades\Facade;

class UserAvailableBalanceFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return UserAvailableBalanceServiceContract::class;
	}

}