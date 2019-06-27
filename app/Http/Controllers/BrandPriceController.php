<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandPriceStoreRequest;
use App\Model\Brand as BrandModel;
use App\Model\BrandPrice;
use Illuminate\Http\Request;
use \App\Http\Resources\BrandPrice as BrandPriceResource;

class BrandPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  BrandModel  $brand
     * @param  BrandPriceStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandModel $brand, BrandPriceStoreRequest $request)
    {
        $price = \BrandPrice::store($brand, $request);

        return new BrandPriceResource($price);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\BrandPrice  $brandPrice
     * @return \Illuminate\Http\Response
     */
    public function show(BrandPrice $brandPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\BrandPrice  $brandPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(BrandPrice $brandPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\BrandPrice  $brandPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BrandPrice $brandPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\BrandPrice  $brandPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrandPrice $brandPrice)
    {
        //
    }
}
