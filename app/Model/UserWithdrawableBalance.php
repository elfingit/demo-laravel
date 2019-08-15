<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserWithdrawableBalance extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function transactions()
    {
        return $this->hasMany(UserWithdrawableBalanceTransaction::class, 'balance_id', 'id');
    }
}
