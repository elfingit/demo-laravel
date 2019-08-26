<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\AbstractRequest;
use App\Rules\UserWithdravableBalance as UserWithdravableBalanceRule;

class CreatePayoutRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount'    => ['required','numeric', new UserWithdravableBalanceRule(\Auth::user())]
        ];
    }
}
