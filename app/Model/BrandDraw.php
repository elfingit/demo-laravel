<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BrandDraw extends Model
{
    const STATUS_NEW = 'new';
    const STATUS_CHECKED = 'checked';
    const STATUS_EXPIRED = 'expired';
    const STATUS_ERROR_CHECK = 'error_check';

	protected $guarded = ['id'];

    public function brand()
    {
    	return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function scopeIsExists($query, $date)
    {
    	return $query->where('draw_date', $date);
    }
}
