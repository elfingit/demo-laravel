<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-15
 * Time: 09:58
 */

namespace App\Services\Contracts;

use App\Http\Requests\UserUpdateRequest;
use App\Lib\Query\Criteria;
use App\Model\User as UserModel;
use Illuminate\Foundation\Http\FormRequest;

interface UserServiceContract
{
	public function list(Criteria $criteria);
	public function update(UserUpdateRequest $request, UserModel $user);
	public function getStatuses();
	public function changeStatus(FormRequest $request, UserModel $user);
	public function changeAuthorizationStatus(FormRequest $request, UserModel $user);
	public function getFieldValue($field, UserModel $user);
}
