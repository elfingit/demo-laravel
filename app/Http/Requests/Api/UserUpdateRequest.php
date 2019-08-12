<?php

namespace App\Http\Requests\Api;

use App\Rules\OldUserPassword;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo'         => 'sometimes|required|file|mimes:jpeg|max:'.(1024 * 1024 * 5),
            'honorific'     => 'sometimes|required|in:mr,mrs',
            'old_password'  => ['required_with:password','string','min:6', new OldUserPassword(\Auth::user())],
            'password'      => 'sometimes|required|string|min:6|confirmed',
            'day_of_birth'     => 'sometimes|required|numeric|min:1|max:31',
            'month_of_birth'     => 'sometimes|required|numeric|min:1|max:12',
            'year_of_birth'     => 'sometimes|required|numeric|min:'. (date('Y') - 100)
                                   .'|max:'. (date('Y') - 18),
            'time_zone'     => 'sometimes|required|numeric',

            'house_number'  => 'sometimes|required|string|max:10',
            'street'        => 'sometimes|required|string|min:2',
            'zip'           => 'sometimes|required|string',
            'region'        => 'sometimes|required|string'

        ];
    }
}
