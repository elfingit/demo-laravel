<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BetTicket extends Model
{
    const STATUS_WAIT = 'wait';
    const STATUS_PLAYED = 'played';
    const STATUS_WIN = 'win';

    protected $casts = [
        'line'  => 'array',
        'extra_balls'  => 'array',
        'extra_games'  => 'array',
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
