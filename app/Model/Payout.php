<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payout extends Model
{
    use SoftDeletes;

    const STATUS_PENDING = 'pending';
    const STATUS_REJECT = 'reject';
    const STATUS_APPROVE = 'approve';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
