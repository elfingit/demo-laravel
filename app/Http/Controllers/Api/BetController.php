<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\BetCollection;
use App\Http\Controllers\Controller;

class BetController extends Controller
{
    public function index()
    {
        $bets = \ApiBet::listOfAuthUser();

        return new BetCollection($bets);
    }
}
