<?php

namespace App\Http\Requests;

class UserShowFieldRequest extends AbstractRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'field' => 'required:in:email,phone'
        ];
    }
}
