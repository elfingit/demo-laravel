<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BrandCheckDate extends Model
{
    const PERIOD_DAY = 1;
    const PERIOD_WEEK = 2;

	protected $guarded = ['id'];

	protected $dates = [
		'next_check_date'
	];

	public function brand()
	{
		return $this->belongsTo(Brand::class, 'brand_id', 'id');
	}

	public function scopeReadyForCheck($query, $date)
	{
		return $query->whereDate('next_check_date', '<=', $date);
	}
}
