<?php

namespace App\Rules;

use App\Model\User as UserModel;
use Illuminate\Contracts\Validation\Rule;

class OldUserPassword implements Rule
{
    /** @var UserModel  */
    protected $user;

    /**
     * Create a new rule instance.
     *
     * @param UserModel $user
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
        if (\Hash::check($value, $this->user->password) === true) {
            return  true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The old password is mismatch';
    }
}
