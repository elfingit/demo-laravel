<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateBetRequest;
use App\Http\Resources\BetResource;
use App\Model\Bet as BetModel;
use Illuminate\Http\Request;

class BetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bets = \Bet::list($request);
        $brands = \Brand::list(null);
        $statuses = \Bet::getStatuses();

        return view('bet.index', compact('bets', 'brands', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BetModel $bet)
    {
        return view('bet.show', compact('bet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  BetModel  $bet
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBetRequest $request, BetModel $bet)
    {
        $bet = \Bet::changeBetStatus($bet, $request->get('status'));

        return new BetResource($bet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
