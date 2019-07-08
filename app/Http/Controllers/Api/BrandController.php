<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\BrandsCollection;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
	public function index()
	{
		return new BrandsCollection(\ApiBrand::list());
	}
}
