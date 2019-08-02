<?php

namespace App\Http\Requests;

use App\Model\Bet as BetModel;

class UpdateBetRequest extends AbstractRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $statuses = array_keys(\Bet::getStatuses());

        return [
            'status'    => 'required|in:'.implode(',', $statuses)
        ];
    }
}
