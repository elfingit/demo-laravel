<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandShortResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
    	$branResult = $this->results()
                           ->orderBy('draw_date', 'desc')
                           ->first();

        return [
        	'id'        => $this->api_code,
	        'name'      => $this->name,
	        'logo'      => asset('images/logos/' . $this->logo),
            'jack_pot'  => $branResult->jack_pot,
            'next_draw' => $this->checkDates[0]
        ];
    }
}
