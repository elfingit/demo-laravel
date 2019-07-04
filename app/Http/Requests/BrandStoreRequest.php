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
	        'code'  => 'required|string|regex:/^[a-zA-z_]+$/i|unique:brands,api_code',
	        'logo'  => 'required|file|image|mimes:jpeg,png,svg|max:'.(1024 * 1024 * 5)
        ];
    }
}
