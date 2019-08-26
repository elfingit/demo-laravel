<?php

namespace App\Http\Requests;

use App\Model\UserPayoutRequest as UserPayoutRequestModel;

class ChangePayoutStatusRequest extends AbstractRequest
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
                    UserPayoutRequestModel::STATUS_APPROVED,
                    UserPayoutRequestModel::STATUS_DECLINED
                ])
        ];
    }
}
