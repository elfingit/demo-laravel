<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Jobs\CaptureBrandDrawJob;
use App\Jobs\CaptureBrandJackpotJob;
use App\Model\Brand as BrandModel;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = \Brand::list(25);
    	return view('brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandStoreRequest $request)
    {
		\Brand::store($request);

		return redirect()->route('dashboard.brands.index')
		                 ->with('system_message', __('Brand successfully added.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(BrandModel $brand)
    {
        return view('brand.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(BrandModel $brand)
    {
    	return view('brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandUpdateRequest $request, BrandModel $brand)
    {
        \Brand::update($request, $brand);

	    return redirect()->route('dashboard.brands.index')
	                     ->with('system_message', __('Brand successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrandModel $brand)
    {
        //
    }

    public function renew(BrandModel $brand)
    {

	    return redirect()->route('dashboard.brands.index')
		        ->with('system_message', __('Backgrounds tasks were started, please wait while are will finished'));
    }
}
