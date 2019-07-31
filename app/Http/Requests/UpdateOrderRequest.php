<?php

namespace App\Http\Requests;

use App\Model\Order as OrderModel;

class UpdateOrderRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status'    => 'required|in:'.implode(',', [
                    OrderModel::STATUS_NEW,
                    OrderModel::STATUS_PAID,
                    OrderModel::STATUS_CANCELLED,
                    OrderModel::STATUS_IN_PROGRESS,
                    OrderModel::STATUS_REFUND,
                    OrderModel::STATUS_CLOSED
                ])
        ];
    }
}
