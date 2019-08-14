<?php

namespace App\Http\Requests;

use App\Model\User as UserModel;
use App\Rules\BetAuthDoc;
use Illuminate\Foundation\Http\FormRequest;

class UserAuthDocStoreRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = UserModel::find($this->get('user_id'));

        return [
            'doc'   => 'required|file|mimes:jpeg,pdf',
            'type'  => 'required|string|min:2|max:255',
            'comments' => 'string|min:3|max:65535',
            'user_id' => 'required|exists:users,id',
            'valid_till' => 'sometimes|date',
            'bet_id'    => ['sometimes','required','exists:bets,id', new BetAuthDoc($user)]
        ];
    }
}
