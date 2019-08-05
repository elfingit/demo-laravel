<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    const STATUS_PAID = 'paid';
    const STATUS_WAITING_DRAW = 'waiting_draw';
    const STATUS_PLAYED = 'played';
    const STATUS_WIN = 'win';
    const STATUS_REFUND = 'refund';
    const STATUS_AUTH_PENDING = 'auth_pending';
    const STATUS_NOT_AUTH = 'not_auth';
    const STATUS_PAYOUT_PENDING = 'payout_pending';
    const STATUS_PAYOUT = 'payout';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_CLOSED = 'closed';


    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'draw_date' => 'datetime'
    ];

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function tickets()
    {
        return $this->hasMany(BetTicket::class, 'bet_id', 'id');
    }

    public function wait_tickets()
    {
        return $this->hasMany(BetTicket::class, 'bet_id', 'id')
                ->where('bet_tickets.status', BetTicket::STATUS_WAIT);
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
