<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    const STATUS_IN_SYNC = 'in_sync';
	const STATUS_SYNCED = 'synced';
	const STATUS_ERR_SYNC = 'err_sync';
	const STATUS_DISABLED = 'disabled';

	protected $guarded = ['id'];

	protected $casts = [
		'default_quick_pick'    => 'array'
	];

	public function prices()
	{
		return $this->hasMany(BrandPrice::class, 'brand_id', 'id');
	}

	public function results()
	{
		return $this->hasMany(BrandResult::class, 'brand_id', 'id');
	}

	public function extra_games()
	{
		return $this->hasMany(BrandExtraGame::class, 'brand_id', 'id');
	}

	public function checkDates()
	{
		return $this->hasMany(BrandCheckDate::class, 'brand_id', 'id')
            ->orderBy('check_date', 'ASC');
	}

	public function betsForPlay()
    {
        return $this->hasMany(Bet::class, 'brand_id', 'id')
                ->where('bet.status', Bet::STATUS_PAID);
    }
}
