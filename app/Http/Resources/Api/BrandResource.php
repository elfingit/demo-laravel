<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
	        'id'    => $this->api_code,
	        'name'  => $this->name,
	        'logo'  => asset('images/logos/' . $this->logo),
			'jackpot_multiplier' => $this->jackpot_multiplier,
			'number_shield' => $this->number_shield,
			'default_quick_pick' => $this->default_quick_pick,
			'primary_pool'      => $this->primary_pool,
			'primary_pool_combination' => $this->primary_pool_combination,
			'special_pool'  => $this->special_pool,
			'special_pool_combination'  => $this->special_pool_combination,
			'name_of_special_pool' => $this->name_of_special_pool,
			'duration' => $this->duration,
			'subscription' => $this->subscription,
			'jackpot_hut' => $this->jackpot_hut,
	        'participation' => $this->participation,
	        'extra_game' => $this->extra_game,
	        'tickets_count' => $this->tickets_count
        ];
    }
}
