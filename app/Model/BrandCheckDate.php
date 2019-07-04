<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BrandCheckDate extends Model
{
    const PERIOD_DAY = 1;
    const PERIOD_WEEK = 2;

	protected $guarded = ['id'];
}
