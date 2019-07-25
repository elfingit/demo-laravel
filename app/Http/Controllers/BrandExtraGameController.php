<?php

namespace App\Http\Controllers;


use App\Http\Requests\BrandExtraGameStoreRequest;
use App\Http\Resources\BrandExtraGameResource;
use App\Model\Brand as BrandModel;
use App\Model\BrandExtraGame as BrandExtraGameModel;

class BrandExtraGameController extends Controller
{
    public function store(BrandExtraGameStoreRequest $request, BrandModel $brand)
    {
	    $extraGame = \BrandExtraGame::store($brand, $request);

	    return new BrandExtraGameResource($extraGame);
    }

    public function index(BrandModel $brand)
    {
    	return BrandExtraGameResource::collection($brand->extra_games);
    }

    public function update(BrandExtraGameStoreRequest $request, BrandModel $brand, BrandExtraGameModel $extra_game)
    {
	    $extraGame = \BrandExtraGame::update($extra_game, $request);

	    return new BrandExtraGameResource($extraGame);
    }

    public function destroy(BrandModel $brand, BrandExtraGameModel $extra_game)
    {
	    \BrandExtraGame::delete($extra_game);


    }
}
