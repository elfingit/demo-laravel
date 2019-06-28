<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-28
 * Time: 15:42
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateUserRequest;
use App\Http\Resources\Api\UserResource;

class UserController extends Controller
{
	public function create(CreateUserRequest $request)
	{
		$user = \ApiUser::create($request);

		return UserResource::make($user);
	}
}