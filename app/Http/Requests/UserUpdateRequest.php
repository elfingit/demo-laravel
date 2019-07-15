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
            'email'    => 'required|email|unique:users,email,'.$user->id,
		    'password' => 'nullable|string|min:6|confirmed',
		    'user_role' => 'required|in:'.implode(',', \UserRole::getRolesIds())
        ];
    }
}
