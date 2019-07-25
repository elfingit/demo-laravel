<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-25
 * Time: 09:52
 */

namespace App\Services;

use App\Model\Brand as BrandModel;
use App\Model\BrandExtraGame as BrandExtraGameModel;
use App\Services\Contracts\BrandExtraGameServiceContract;
use Illuminate\Foundation\Http\FormRequest;

class BrandExtraGameService implements BrandExtraGameServiceContract
{
	public function store( BrandModel $brand, FormRequest $request )
	{
		$data = $request->only(['game_name', 'game_price']);
		$data['system_name'] = \Str::slug($data['game_name']);

		$extraGame = new BrandExtraGameModel($data);

		$brand->extra_games()->save($extraGame);

		return $extraGame;
	}
}