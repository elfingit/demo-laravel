<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderTransaction extends Pivot
{
    protected $table = 'order_transactions';

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function transaction()
    {
        return $this->belongsTo(UserAvailableBalanceTransaction::class,
            'transaction_id', 'id');
    }
}
