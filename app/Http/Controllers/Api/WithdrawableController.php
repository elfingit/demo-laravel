<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\WithdrawableRequest;
use App\Http\Resources\Api\WithdrawableResource;
use App\Http\Controllers\Controller;

class WithdrawableController extends Controller
{
    public function balance()
    {
        $user = \Auth::user();

        if (!$user->withdrawable_balance) {
            return response()->json([
                'amount'    => 0
            ]);
        }

        return new WithdrawableResource($user->withdrawable_balance);
    }

    public function requestForPayout(WithdrawableRequest $request)
    {
        \ApiWithdrawable::store($request, \Auth::user());
    }
}
