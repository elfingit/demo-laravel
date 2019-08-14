<?php

namespace App\Observers;

use App\Model\Bet as BetModel;
use Carbon\Carbon;

class BetStatusObserver
{
    public function updating(BetModel $bet)
    {
        if ($bet->isDirty(['status']) && $bet->status == BetModel::STATUS_AUTH_PENDING) {
            $date = Carbon::now();
            $date->addDays(14);
            $bet->countdown_status = $date;
        }
    }
}
