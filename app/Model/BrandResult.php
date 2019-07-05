<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BrandResult extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
    	'results' => 'object'
    ];

    public function scopeIsExists($query, $date, $brand)
    {
    	return $query->where('draw_date', $date)
		            ->where('brand_id', $brand->id)
		            ->first();
    }
}
