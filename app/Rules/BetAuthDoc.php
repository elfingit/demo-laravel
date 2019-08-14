<?php

namespace App\Rules;

use App\Model\Bet as BetModel;
use App\Model\User as UserModel;
use Illuminate\Contracts\Validation\Rule;

class BetAuthDoc implements Rule
{

    protected $user;
    protected $message = '';
    /**
     * Create a new rule instance.
     * @param UserModel $user
     * @return void
     */
    public function __construct(UserModel $user = null)
    {
        $this->user = $user;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $bet = BetModel::find($value);

        if (!$this->user) {
            return false;
        }

        if ($bet->user_id != $this->user->id) {
            $this->message = 'This bet is not bet of this user';
            return false;
        }

        if ($bet->status != BetModel::STATUS_AUTH_PENDING) {
            $this->message = 'Bet must have status: "Authorization pending"';
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
