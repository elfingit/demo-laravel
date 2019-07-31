<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-31
 * Time: 17:48
 */
namespace App\Services;

use App\Services\Contracts\BetServiceContract;
use Illuminate\Support\Collection;

class BetService implements BetServiceContract
{
    public function changeBetsStatus( Collection $bets, $status )
    {
        \DB::transaction(function () use ($bets, $status) {
            foreach ($bets as $bet) {
                $bet->status = $status;
                $bet->save();
            }
        });
    }
}
