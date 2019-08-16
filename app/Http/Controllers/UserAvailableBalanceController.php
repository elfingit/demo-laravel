<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAvailableBalanceStoreRequest;
use App\Http\Resources\BalanceResource;
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
		if (is_null($user->available_balance)) {
			return new UserResource($user);
		}

		return new BalanceResource($user);
    }

    public function store(UserAvailableBalanceStoreRequest $request, UserModel $user)
    {
	    $transaction = \UserAvailableBalance::add(
			$request->get('amount'),
			$request->get('reason') . ' | Added by ' . \Auth::user()->id .'<'.\Auth::user()->email.'>',
			$user
			);

	    $user->refresh();

		return response()->json([
			'data' => [
				'amount'    => $user->available_balance->amount,
				'withdrawable_amount' => $transaction
			]
		]);
    }
}
