<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\BrandResource;
use App\Http\Resources\Api\BrandResultsCollection;
use App\Http\Resources\Api\BrandsCollection;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
	public function index()
	{
		return new BrandsCollection(\ApiBrand::list());
	}

	public function show($brand)
	{
		$brandObject = \ApiBrand::getBrand($brand);

		if (!$brandObject) {
			abort(404);
		}

		return new BrandResource($brandObject);
	}

	public function results($brand)
	{
		$results = \ApiBrand::getResults($brand);

		if (!$results) {
			abort(404);
		}

		return new BrandResultsCollection($results);

	}
}
