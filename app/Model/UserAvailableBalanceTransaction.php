<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserAvailableBalanceTransaction extends Model
{
    protected $guarded = ['id'];

    public function orders()
    {
        return $this->hasOneThrough(OrderTransaction::class, Order::class);
    }
}
