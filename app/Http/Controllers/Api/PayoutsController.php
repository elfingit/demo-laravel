<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePayoutRequest;
use App\Http\Controllers\Controller;

class PayoutsController extends Controller
{
    public function store(CreatePayoutRequest $request)
    {
        \ApiPayout::freeze($request, \Auth::user());
    }
}
