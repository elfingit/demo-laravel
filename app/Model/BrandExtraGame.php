<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BrandExtraGame extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function scopeBySystemName(Builder $builder, $system_name)
    {
        return $builder->where('system_name', $system_name)->first();
    }
}
