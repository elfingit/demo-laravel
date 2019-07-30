<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_NEW = 'new';
    const STATUS_PAID = 'paid';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_REFUND = 'refund';
    const STATUS_CLOSED = 'closed';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function bets()
    {
        return $this->hasMany(Bet::class, 'order_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function transaction()
    {
        return $this->hasOneThrough(
            UserAvailableBalanceTransaction::class,
            OrderTransaction::class,
            'order_id',
            'id',
            'id',
            'transaction_id');
    }
}
