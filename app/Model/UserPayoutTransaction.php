<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserPayoutTransaction extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function request()
    {
        return $this->hasOne(UserPayoutRequest::class, 'id', 'request_id');
    }
}
