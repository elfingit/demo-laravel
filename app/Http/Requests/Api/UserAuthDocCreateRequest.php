<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\AbstractRequest;

class UserAuthDocCreateRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'doc'   => 'required|file|mimes:jpeg,pdf|max:'.(1024 * 1024 * 5)
        ];
    }
}
