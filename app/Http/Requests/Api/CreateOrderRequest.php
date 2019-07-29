<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\AbstractRequest;

class CreateOrderRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'host'          => 'required|regex:/(?=^.{1,254}$)(^(?:(?!\d+\.)[a-zA-Z0-9_\-]{1,63}\.?)+(?:[a-zA-Z]{2,})$)/',
            'favicon_url'   => 'required|url',
            'cart_items'    => 'required|array'
        ];
    }
}
