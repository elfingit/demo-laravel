<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawableResource extends JsonResource
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
            'available_amount' => $this->available_amount,
            'pending_amount'   => $this->pending_amount,
            'amount'           => $this->amount
        ];
    }
}
