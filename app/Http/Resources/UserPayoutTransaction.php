<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPayoutTransaction extends JsonResource
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
            'id'        => $this->transaction_id,
            'amount'    => $this->amount,
            'type'    => $this->request->type,
            'status'    => $this->request->status,
            'notes'     => $this->notes
        ];
    }
}
