<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $lead = $this->route('lead');

    	return [
            'cart_items' => 'required|array',
	        'host'  => 'required|exists:leads,host,id,'.$lead->id
        ];
    }
}
