<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\AbstractRequest;

class CreateUserRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'         => 'required|email|unique:users,email',
	        'password'      => 'required|string|min:6',
	        'host'          => 'required|regex:/(?=^.{1,254}$)(^(?:(?!\d+\.)[a-zA-Z0-9_\-]{1,63}\.?)+(?:[a-zA-Z]{2,})$)/',
	        'favicon_url'   => 'required|url'
        ];
    }
}
