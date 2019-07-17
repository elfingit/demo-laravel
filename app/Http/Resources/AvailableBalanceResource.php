<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AvailableBalanceResource extends JsonResource
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
		        'amount' => $this->available_balance->amount,
		        'transactions' => $this->available_balance->transactions
	        ]
        ];
    }
}
