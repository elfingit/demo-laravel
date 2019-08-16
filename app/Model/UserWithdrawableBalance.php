<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserWithdrawableBalance extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getAmountAttribute()
    {
        return $this->pending_amount + $this->available_amount;
    }

    public function transactions()
    {
        return $this->hasMany(UserWithdrawableBalanceTransaction::class, 'balance_id', 'id');
    }
}
