<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandPrice extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
        	'id'        => $this->id,
	        'combination_price'   => $this->combination_price,
	        'number_shield_price'   => $this->number_shield_price,
	        'currency'  => $this->currency,
	        'brand_id'     => $this->brand_id
        ];
    }
}
