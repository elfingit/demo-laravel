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

		$user->save();
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
            case 'is_doc_rejected':
                \UserAuthDoc::rejectDoc($user, $request);
                break;
            case 'is_doc_approved':
                \UserAuthDoc::approveDoc($user, $request);
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
