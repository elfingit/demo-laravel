<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandPriceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'combination_price' => $this->combination_price,
            'number_shield_price' => $this->number_shield_price
        ];
    }
}
