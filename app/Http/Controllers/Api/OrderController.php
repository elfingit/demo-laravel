<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateOrderRequest;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function store(CreateOrderRequest $request)
    {
        $order = \ApiOrder::create($request, $request->user());
    }
}
