<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-28
 * Time: 16:57
 */

namespace App\Services\Api;

use App\Model\User;
use App\Model\UserProfile;
use App\Model\UserRole;
use App\Services\Api\Contracts\UserServiceContract;
use Illuminate\Foundation\Http\FormRequest;

class UserService implements UserServiceContract
{
	public function create( FormRequest $request )
	{
		$role = UserRole::byName('user')->first();

		$profile = new UserProfile([
			'host'  => $request->get('host'),
			'favicon'  => $request->get('favicon_url'),
		]);

		$user = User::create([
			'email'         => $request->get('email'),
			'password'      => \Hash::make($request->get('password')),
			'user_role_id'  => $role->id
		]);

		$user->profile()->save($profile);

		return $user;
	}
}