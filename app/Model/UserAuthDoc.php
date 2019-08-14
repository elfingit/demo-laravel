<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserAuthDoc extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getStatusAttribute()
    {
        $status = 'Pending';

        if ($this->is_approved) {
            $status = 'Is Approved';
        } elseif ($this->is_rejected) {
            $status = 'Is Rejected';
        }

        return $status;
    }

    public function bet() {
        return $this->hasOne(Bet::class, 'id', 'bet_id');
    }
}
