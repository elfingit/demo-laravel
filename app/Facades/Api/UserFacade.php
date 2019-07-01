<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-28
 * Time: 16:58
 */

namespace App\Facades\Api;

use App\Services\Api\Contracts\UserServiceContract;
use Illuminate\Support\Facades\Facade;

class UserFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return UserServiceContract::class;
	}

}