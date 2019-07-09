<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
		$leads = \Lead::list($request);

		return view('lead.index', compact('leads'));
    }
}
