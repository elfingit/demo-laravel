<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\AbstractRequest;
use App\Model\User as UserModel;

class UserChangeStatusRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => 'required|in:'.implode(',', [
                    UserModel::STATUS_ACTIVE,
                    UserModel::STATUS_SELF_EXCLUDED,
                    UserModel::STATUS_CLOSED
                ]),
            'time'  => 'sometimes|required|in:6m,9m,1y,2y,5y'
        ];
    }
}
