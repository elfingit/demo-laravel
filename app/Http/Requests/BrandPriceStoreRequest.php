<?php

namespace App\Http\Requests;

class BrandPriceStoreRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'combination_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
			'number_shield_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
	        'currency'  => 'required|in:EUR'
        ];
    }
}
