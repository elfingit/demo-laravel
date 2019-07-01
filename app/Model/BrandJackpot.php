<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BrandJackpot extends Model
{
	protected $guarded = ['id'];

	public function scopeIsExists($query, $date)
	{
		return $query->where('next_draw', $date);
	}
}
