<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateOrderRequest;
use App\Http\Controllers\Controller;
use App\Services\Exceptions\InsufficientAvailableBalanceException;

class OrderController extends Controller
{
    public function store(CreateOrderRequest $request)
    {
        try {
            $order = \ApiOrder::create( $request, $request->user() );
        } catch (InsufficientAvailableBalanceException $exception) {
            abort(402);
        }
    }
}
