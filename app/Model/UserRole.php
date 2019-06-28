<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    const ROLE_ADMINISTRATOR = 'admin';

    protected $guarded = ['id'];
}
