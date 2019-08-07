<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-28
 * Time: 16:57
 */

namespace App\Services\Api;

use App\Model\User as UserModel;
use App\Model\UserProfile as UserProfileModel;
use App\Model\UserRole as UserRoleModel;
use App\Services\Api\Contracts\UserServiceContract;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UserService implements UserServiceContract
{
	public function create( FormRequest $request )
	{
		$role = UserRoleModel::byName('user')->first();

		$dateOfBirth = Carbon::parse(
			$request->get('day_of_birth').'-'
			.$request->get('month_of_birth').'-'
			.$request->get('year_of_birth')
		);

		$profile = new UserProfileModel([
			'host'          => $request->get('host'),
			'favicon'       => $request->get('favicon_url'),
			'honorific'     => $request->get('honorific'),
			'first_name'     => $request->get('first_name'),
			'last_name'     => $request->get('last_name'),
			'date_of_birth' => $dateOfBirth,
			'country'     => $request->get('country'),
            'time_zone'     => $request->get('time_zone')
		]);

		$user = UserModel::create([
			'email'         => $request->get('email'),
			'password'      => \Hash::make($request->get('password')),
			'user_role_id'  => $role->id
		]);

		$user->profile()->save($profile);

		return $user;
	}

    public function getUserBalance( UserModel $user )
    {
        if ($user->available_balance) {
            return $user->available_balance->amount;
        }

        return 0;
    }
}
