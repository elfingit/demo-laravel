<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserPayoutRequest extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_DECLINED = 'declined';

    const TYPE_EXTERNAL = 'external';
    const TYPE_INTERNAL = 'internal';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
