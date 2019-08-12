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
use App\Http\Requests\Api\UserChangeStatusRequest;
use App\Http\Requests\Api\UserUpdateRequest;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function create(CreateUserRequest $request)
	{
		$user = \ApiUser::create($request);

		return UserResource::make($user);
	}

	public function balance(Request $request)
    {
        $balance = \ApiUser::getUserBalance($request->user());

        return response()->json([
            'balance' => $balance
        ]);
    }

    public function update(UserUpdateRequest $request)
    {
        \ApiUser::update($request);

        return response()->json([], 204);
    }

    public function changeStatus(UserChangeStatusRequest $request)
    {
        \ApiUser::changeStatus($request);

        return response()->json([], 204);
    }
}
