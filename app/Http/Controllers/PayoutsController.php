<?php

namespace App\Http\Controllers;

use App\Model\UserPayoutRequest as UserPayoutRequestModel;
use Illuminate\Http\Request;

class PayoutsController extends Controller
{
    public function index()
    {
        $payouts = \Payout::list();

        return view('payouts.index', compact('payouts'));
    }

    public function show(UserPayoutRequestModel $payout)
    {
        return view('payouts.show', compact('payout'));
    }
}
