<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-15
 * Time: 14:01
 */
namespace App\Facades;

use App\Services\Contracts\UserRoleServiceContract;
use Illuminate\Support\Facades\Facade;

class UserRoleFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return UserRoleServiceContract::class;
	}

}