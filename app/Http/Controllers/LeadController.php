<?php

namespace App\Http\Controllers;

use App\Model\Lead as LeadModel;
use App\Services\Exceptions\InsufficientAvailableBalanceException;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
		$leads = \Lead::list($request);

		return view('lead.index', compact('leads'));
    }

    public function toOrder(LeadModel $lead)
    {
        try {
            $order = \Order::leadToOrder($lead);

            return response()->json([
                'url'   => route('dashboard.orders.show', ['order' => $order->id])
            ]);

        } catch (InsufficientAvailableBalanceException $e) {
            return response()->json([
                'message'   => $e->getMessage()
            ], 402);
        }

    }
}
