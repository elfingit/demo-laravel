<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-31
 * Time: 17:47
 */
namespace App\Services\Contracts;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface BetServiceContract
{
    public function changeBetsStatus(Collection $bets, $status);

    public function list(Request $request);

    public function getStatuses();
}