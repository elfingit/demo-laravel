<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeWinAmountByBrand(Builder $query, $brand_id, $bet_id)
    {
        return $query->where('status', self::STATUS_WIN)
            ->where('brand_id', $brand_id)
            ->where('bet_id', $bet_id)
            ->sum('win_amount');
    }

    public function getExtraGamesHumanAttribute()
    {

        $games = array_map(function ($game) {
            return $game['system_name'];
        }, $this->extra_games);

        return $games;
    }
}
