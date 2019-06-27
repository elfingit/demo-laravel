<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BrandPrice extends Model
{
    protected $guarded = ['id'];

    public function brand()
    {
    	return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
}
