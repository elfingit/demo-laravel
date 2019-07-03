<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BrandResult extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
    	'results' => 'array'
    ];
}
