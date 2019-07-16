<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $guarded = ['user_id'];

    protected $primaryKey = 'user_id';

    protected $casts = [
    	'date_of_birth'  => 'date'
    ];

}
