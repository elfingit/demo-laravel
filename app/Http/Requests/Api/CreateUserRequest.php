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
	        'honorific'     => 'required|in:mr,mrs',
	        'first_name'     => 'required|string|max:255',
	        'last_name'     => 'required|string|max:255',
	        'day_of_birth'     => 'required|numeric|min:1|max:31',
	        'month_of_birth'     => 'required|numeric|min:1|max:12',
	        'year_of_birth'     => 'required|numeric|min:'. (date('Y') - 100)
	                               .'|max:'. (date('Y') - 18),
	        'country'           => 'required|in:' . implode(',', config('countries')),
	        'host'          => 'required|regex:/(?=^.{1,254}$)(^(?:(?!\d+\.)[a-zA-Z0-9_\-]{1,63}\.?)+(?:[a-zA-Z]{2,})$)/',
	        'favicon_url'   => 'required|url'
        ];
    }
}
