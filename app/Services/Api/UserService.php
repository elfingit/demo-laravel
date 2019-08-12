<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-28
 * Time: 16:57
 */

namespace App\Services\Api;

use App\Model\User as UserModel;
use App\Model\UserAddress as UserAddressModel;
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

    public function update( FormRequest $request )
    {
        $user = $request->user();

        $profile = $user->profile;

        //Profile data
        if (!$profile) {
            $profile = new UserProfileModel();
            $profile->user_id = $user->id;
        }

        if ($request->has('photo')) {
            $file_name = $this->uploadPhoto($request);
            $profile->photo = $file_name;
        }

        if ($request->has('honorific')) {
            $profile->honorific = $request->get('honorific');
        }

        if ($request->has('day_of_birth')
            && $request->has('month_of_birth')
            && $request->has('year_of_birth')) {

            $dateOfBirth = Carbon::parse(
                $request->get('day_of_birth').'-'
                .$request->get('month_of_birth').'-'
                .$request->get('year_of_birth')
            );


            $profile->date_of_birth = $dateOfBirth;
        }

        if ($request->has('time_zone')) {
            $profile->time_zone = $request->get('time_zone');
        }

        //User data
        if ($request->has('password')) {
            $user->password = \Hash::make($request->get('password'));
        }

        //User address
        $address = $user->address;

        if (!$address) {
            $address = new UserAddressModel();
            $address->user_id = $user->id;
        }

        if ($request->has('house_number')) {
            $address->house_number = $request->get('house_number');
        }

        if ($request->has('street')) {
            $address->street = $request->get('street');
        }

        if ($request->has('zip')) {
            $address->zip = $request->get('zip');
        }

        if ($request->has('region')) {
            $address->region = $request->get('region');
        }


        $user->save();
        $profile->save();
        $address->save();

        return $user;
    }

    protected function uploadPhoto(FormRequest $request) {

	    $user = $request->user();

	    $path = storage_path('app/public/user_photos/' . $user->id);

	    if (!file_exists($path)) {
	        mkdir($path, 0775, true);
        }

	    $file_name = 'photo.' . $request->photo->getClientOriginalExtension();

	    $request->photo->move($path, $file_name);

	    return $file_name;

    }
}
