<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\AbstractRequest;

class WithdrawableRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'transaction_id' => 'required|numeric|exists:user_withdrawable_balance_transactions,transaction_id'
        ];
    }
}
