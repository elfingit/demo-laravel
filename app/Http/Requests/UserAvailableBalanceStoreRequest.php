<?php

namespace App\Http\Requests;

use App\Rules\UserAvailableBalance;

class UserAvailableBalanceStoreRequest extends AbstractRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount'    => ['required','numeric', new UserAvailableBalance($this->route('user'))],
	        'reason'    => 'required|string'
        ];
    }
}
