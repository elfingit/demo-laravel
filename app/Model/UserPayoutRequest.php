<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserPayoutRequest extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_DECLINED = 'declined';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
