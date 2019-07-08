<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    const STATUS_NEW = 'new';
    const STATUS_CONVERTED = 'converted';

	protected $guarded = ['id'];

    protected $casts = [
    	'cart_items' => 'array'
    ];
}
