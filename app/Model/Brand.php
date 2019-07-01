<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    const STATUS_IN_SYNC = 'in_sync';
	const STATUS_SYNCED = 'synced';
	const STATUS_ERR_SYNC = 'err_sync';
	const STATUS_DISABLED = 'disabled';

	protected $guarded = ['id'];

	public function prices()
	{
		return $this->hasMany(BrandPrice::class, 'brand_id', 'id');
	}

	public function draws()
	{
		return $this->hasMany(BrandDraw::class, 'brand_id', 'id')
				->orderBy('draw_date', 'desc');
	}

	public function jackpots()
	{
		return $this->hasMany(BrandJackpot::class, 'brand_id', 'id')
				->orderBy('next_draw', 'desc');;
	}
}
