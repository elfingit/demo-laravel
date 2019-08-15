<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WithdrawableController extends Controller
{
    public function index()
    {
        $transactions = \UserWithdrawabalBalance::getTransactions();

        return view('withdrawable.index', compact('transactions'));
    }
}
