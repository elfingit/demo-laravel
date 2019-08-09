<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAuthDocStoreRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'doc'   => 'required|file',
            'type'  => 'required|string|min:2|max:255',
            'comments' => 'string|min:3|max:65535',
            'user_id' => 'required|exists:users'
        ];
    }
}
