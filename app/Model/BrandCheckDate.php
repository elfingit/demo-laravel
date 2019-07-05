<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BrandCheckDate extends Model
{
    const PERIOD_DAY = 1;
    const PERIOD_WEEK = 2;

	protected $guarded = ['id'];

	public function brand()
	{
		return $this->belongsTo(Brand::class, 'brand_id', 'id');
	}

	public function scopeReadyForCheck($query, $date)
	{
		return $query->where('next_check_date', '<=', $date);
	}
}
