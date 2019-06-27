<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandPriceStoreRequest;
use App\Http\Resources\BrandPriceCollection;
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
    public function index(BrandModel $brand)
    {
        return new BrandPriceCollection(\BrandPrice::list($brand));
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
    public function update(BrandPriceStoreRequest $request, BrandModel $brand, BrandPrice $brandPrice)
    {
	    $price = \BrandPrice::update($brandPrice, $request);

	    return new BrandPriceResource($price);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\BrandPrice  $brandPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrandModel $brand, BrandPrice $brandPrice)
    {
	    \BrandPrice::delete($brand, $brandPrice);
    	return response('', 204);
    }
}
