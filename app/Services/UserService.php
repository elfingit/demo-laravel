<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-15
 * Time: 09:58
 */

namespace App\Services;

use App\Http\Requests\UserUpdateRequest;
use App\Lib\Query\Criteria;
use App\Model\User as UserModel;
use App\Model\UserRole as UserRoleModel;
use App\Services\Contracts\UserServiceContract;

class UserService implements UserServiceContract
{
	public function list( Criteria $criteria )
	{
		return $criteria->paginate();
	}

	public function update( UserUpdateRequest $request, UserModel $user )
	{
		if (!is_null($request->get('password'))) {
			$user->password = \Hash::make($request->get('password'));
		}

		$role = UserRoleModel::find($request->get('user_role'));

		$user->user_role_id = $role->id;

		$user->email = $request->get('email');

		$user->save();
	}
}