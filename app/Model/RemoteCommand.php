<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RemoteCommand extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'key';
    protected $keyType = 'string';
    public $incrementing = false;
}
