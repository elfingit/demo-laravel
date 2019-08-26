<?php

namespace App\Rules;

use App\Model\User as UserModel;
use Illuminate\Contracts\Validation\Rule;

class UserWithdravableBalance implements Rule
{
    /**
     * @var UserModel
     */
    protected $user;

    /**
     * Create a new rule instance.
     * @param UserModel $user
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
        return $this->user->withdrawable_balance->available_amount >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The approved part of balance less than in your request.';
    }
}
