<?php

namespace App\Http\Requests;

class UserUpdateRequest extends AbstractRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->route('user');

    	return [
    	    'honorific' => 'required|in:mr,mrs',
    	    'first_name' => 'required|string|min:2',
    	    'last_name' => 'required|string|min:2',
            'email'    => 'required|email|unique:users,email,'.$user->id,
            'phone'    => 'required|string|min:5',
            'email_subscription'    => 'sometimes|boolean',
            'country'    => 'required|in:' . implode(',', config('countries')),
		    'password' => 'nullable|string|min:6|confirmed',
		    'user_role' => 'required|in:'.implode(',', \UserRole::getRolesIds())
        ];
    }
}
