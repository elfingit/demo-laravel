<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserWithdrawableBalanceTransactionResource extends JsonResource
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
            'id'     => $this->transaction_id,
            'amount' => $this->amount,
            'notes'  => $this->notes,
            'bet_id' => $this->bet_id,
            'status' => $this->status
        ];
    }
}
