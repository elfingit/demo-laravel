<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-15
 * Time: 10:15
 */

namespace App\Facades;

use App\Services\Contracts\UserServiceContract;
use Illuminate\Support\Facades\Facade;

class UserFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return UserServiceContract::class;
	}

}