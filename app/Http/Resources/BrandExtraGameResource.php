<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandExtraGameResource extends JsonResource
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
        	'game_name' => $this->game_name,
	        'game_price' => $this->game_price,
	        'system_name'=> $this->system_name
        ];
    }
}
