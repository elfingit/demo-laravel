<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\UserAvailableBalanceTransactionResource;
use App\Http\Resources\Api\UserWithdrawableBalanceTransactionResource;
use App\Model\UserAvailableBalanceTransaction as UserAvailableBalanceTransactionModel;
use App\Model\UserWithdrawableBalanceTransaction as UserWithdrawableBalanceTransactionModel;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];

        if ($this->transaction instanceof UserAvailableBalanceTransactionModel) {
            $data['transaction'] = new UserAvailableBalanceTransactionResource($this->transaction);
            $data['transaction_type'] = 'available_balance';
        }

        if ($this->transaction instanceof UserWithdrawableBalanceTransactionModel) {
            $data['transaction'] = new UserWithdrawableBalanceTransactionResource($this->transaction);
            $data['transaction_type'] = 'withdrawable_balance';
        }

        return $data;
    }
}
