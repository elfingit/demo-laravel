<?php

namespace App\Http\Requests;

class UserAuthDocStatusRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status'    => 'required|in:0,1'
        ];
    }
}
