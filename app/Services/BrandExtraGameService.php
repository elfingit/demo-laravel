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

	public function update( BrandExtraGameModel $extra_game, FormRequest $request )
	{
		$extra_game->game_name = $request->get('game_name');
		$extra_game->game_price = $request->get('game_price');
		$extra_game->currency = $request->get('currency');

		$extra_game->system_name = \Str::slug($request->get('game_name'));

		$extra_game->save();

		return $extra_game;
	}

	public function delete( BrandExtraGameModel $extra_game )
	{
		$extra_game->delete();

		return response('', 204);
	}
}