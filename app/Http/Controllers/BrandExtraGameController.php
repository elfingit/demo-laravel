<?php

namespace App\Http\Controllers;


use App\Http\Requests\BrandExtraGameStoreRequest;
use App\Http\Resources\BrandExtraGameResource;
use App\Model\Brand as BrandModel;

class BrandExtraGameController extends Controller
{
    public function store(BrandExtraGameStoreRequest $request, BrandModel $brand)
    {
	    $extraGame = \BrandExtraGame::store($brand, $request);

	    return new BrandExtraGameResource($extraGame);
    }
}
