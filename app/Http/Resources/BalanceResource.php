<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BalanceResource extends JsonResource
{
	public static $wrap = 'user';

	/**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
	        'id'    => $this->id,
	        'email' => $this->email,
	        'balance' => [
		        'available_amount' => $this->available_balance->amount,
		        'withdrawable_amount' => $this->withdrawable_balance->amount
	        ]
        ];
    }
}
