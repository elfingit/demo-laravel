<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';
    const STATUS_PLAYED = 'played';
    const STATUS_REFUND = 'refund';
    const STATUS_CHARGE_BACK = 'charge_back';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_AUTH_PENDING = 'auth_pending';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'draw_date' => 'date',
        'line'  => 'array',
        'extra_balls'  => 'array',
        'extra_games'  => 'array',
    ];
}
