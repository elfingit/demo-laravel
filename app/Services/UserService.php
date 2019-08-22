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
use App\Model\UserProfile as UserProfileModel;
use App\Model\UserRole as UserRoleModel;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Foundation\Http\FormRequest;

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

		if ($request->has('email_subscription') && $request->get('email_subscription') == true) {
		    $user->email_subscription = true;
        }

		$user->save();

		$profile = $user->profile;

		if (!$profile) {
		    $profile = new UserProfileModel();
		    $profile->user_id = $user->id;
        }

		$profile->honorific = $request->get('honorific');
		$profile->first_name = $request->get('first_name');
		$profile->last_name = $request->get('last_name');
		$profile->phone = $request->get('phone');
		$profile->country = $request->get('country');

		$profile->save();
	}

    public function getStatuses()
    {
        return [
            UserModel::STATUS_ACTIVE => 'Active',
            UserModel::STATUS_SUSPENDED => 'Suspended',
            UserModel::STATUS_SELF_EXCLUDED => 'Self excluded',
            UserModel::STATUS_SELF_CLOSED => 'Self closed',
            UserModel::STATUS_CLOSED => 'Closed',
        ];
    }

    public function changeStatus( FormRequest $request, UserModel $user )
    {
        $user->status = $request->get('status');
        $user->save();

        return $user;
    }

    public function paramToggle( FormRequest $request, UserModel $user )
    {
        switch ($request->get('name')) {
            case 'authorized':
                $user->is_authorized = $request->get('value');
                $user->save();
                break;
            case 'phone_confirmed':
                $user->phone_confirmed = $request->get('value');
                $user->save();
                break;
            case 'is_fraud_suspected':
                $user->is_fraud_suspected = $request->get('value');
                $user->save();
                break;
            case 'is_test_account':
                $user->is_test_account = $request->get('value');
                $user->save();
                break;
        }

        return $user;
    }

    public function getFieldValue( $field, UserModel $user )
    {
        switch ($field) {
            case 'email':
                return $user->email;
        }
    }
}
