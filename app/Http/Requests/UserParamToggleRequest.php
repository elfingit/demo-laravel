<?php

namespace App\Http\Requests;

class UserParamToggleRequest extends AbstractRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|in:phone_confirmed,authorized,is_test_account,is_fraud_suspected',
            'value' => 'required|boolean'
        ];
    }
}
