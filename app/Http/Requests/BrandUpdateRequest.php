<?php

namespace App\Http\Requests;

class BrandUpdateRequest extends BrandStoreRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rulez = parent::rules();

	    $brand = $this->route('brand');

        $rulez['logo'] = 'file|image|mimes:jpeg,png,svg|max:\'.(1024 * 1024 * 5)';
        $rulez['code'] = 'required|string|regex:/^[a-zA-z_]+$/i|unique:brands,api_code,' . $brand->id;

        return $rulez;
    }
}
