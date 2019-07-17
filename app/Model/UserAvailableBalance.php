<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserAvailableBalance extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
    	$this->belongsTo(User::class, 'id', 'user_id');
    }

    public function transactions()
    {
    	return $this->hasMany(UserAvailableBalanceTransaction::class, 'available_balance_id', 'id');
    }
}
