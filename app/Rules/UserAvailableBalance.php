<?php

namespace App\Rules;

use App\Model\User as UserModel;
use Illuminate\Contracts\Validation\Rule;

class UserAvailableBalance implements Rule
{
    protected $user;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(UserModel $user)
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
        $user_balance_amount = isset($this->user->available_balance) ? $this->user->available_balance->amount : 0;

        if ($value < 0 && $user_balance_amount + $value < 0) {
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
        return 'You can\'t set user balance less than zero.';
    }
}
