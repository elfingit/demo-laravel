<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-15
 * Time: 13:03
 */

namespace App\Services;

use App\Model\UserRole as UserRoleModel;
use App\Services\Contracts\UserRoleServiceContract;

class UserRoleService implements UserRoleServiceContract
{
	public function list()
	{
		return UserRoleModel::all();
	}

}