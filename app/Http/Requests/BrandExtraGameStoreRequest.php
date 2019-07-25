<?php

namespace App\Http\Requests;


class BrandExtraGameStoreRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'game_name'  => 'required|string',
            'game_price' => 'required|regex:/^\d+(\.\d{1,2})?$/'
        ];
    }
}
