<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAvailableBalanceStoreRequest;
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

    public function store(UserAvailableBalanceStoreRequest $request, UserModel $user)
    {
		$user = \UserAvailableBalance::add(
			$request->get('amount'),
			$request->get('reason') . '| Added by ' . \Auth::user()->id .'<'.\Auth::user()->email.'>',
			$user
			);

		return new UserResource($user);
    }
}
