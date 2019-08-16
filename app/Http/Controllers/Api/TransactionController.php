<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\UserTransactionCollection;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $transactions = $user->transactions()
                    ->orderBy('updated_at', 'desc')
                    ->paginate(25);
        return new UserTransactionCollection($transactions);
    }
}
