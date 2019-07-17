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
	        'logo'  => 'required|file|image|mimes:jpeg,png,svg|max:'.(1024 * 1024 * 5),
		    'tickets_count' => 'required|numeric',
		    'default_quick_pick' => 'required|string',
		    'primary_pool'  => 'required|numeric',
		    'primary_pool_combination'  => 'required|numeric',
		    'special_pool'  => 'required|numeric',
		    'special_pool_combination'  => 'required|numeric',
		    'name_of_special_pool'  => 'required|string',
		    'jackpot_multiplier'  => 'nullable|boolean',
		    'number_shield'  => 'nullable|boolean',
		    'duration'  => 'nullable|boolean',
		    'subscription'  => 'nullable|boolean',
		    'jackpot_hut'  => 'nullable|boolean',
		    'participation'  => 'nullable|boolean',
		    'extra_game'  => 'nullable|boolean',
		    'result_date' => 'required|array',
		    'result_date.*' => 'required|date',
            'hours' => 'required|array',
		    'hours.*'   => 'required|numeric|min:0|max:23',
            'minutes' => 'required|array',
		    'minutes.*'   => 'required|numeric|min:0|max:59',
		    'period'    => 'required|in:1,2'
        ];
    }
}
