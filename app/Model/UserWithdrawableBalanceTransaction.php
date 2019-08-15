<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserWithdrawableBalanceTransaction extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_BLOCKED_NO_AUTH = 'blocked_no_auth';
    const STATUS_AUTH = 'auth';
    const STATUS_INTERNAL_PAYOUT = 'internal_payout';
    const STATUS_EXTERNAL_PAYOUT = 'external_payout';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
