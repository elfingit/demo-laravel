<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Model\User as UserModel;
use Illuminate\Http\Request;

class UserAvailableBalanceController extends Controller
{
    public function show(UserModel $user)
    {
    	return view('available_balance.show', compact('user'));
    }

    public function index(Request $request, UserModel $user)
    {
		$data = \UserAvailableBalance::list($request, $user);

		if (is_null($data)) {
			return new UserResource($user);
		}
    }
}
