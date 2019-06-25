<?php

namespace App\Http\Requests;


class BrandStoreRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required|string|min:3|max:255',
	        'code'  => 'required|string|regex:/^[a-zA-z_]+$/i',
	        'logo'  => 'required|file|image|mimes:jpeg,png,svg|size:'.(1024 * 5)
        ];
    }
}
