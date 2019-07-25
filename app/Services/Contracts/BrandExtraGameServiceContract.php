<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-25
 * Time: 09:48
 */

namespace App\Services\Contracts;

use App\Model\Brand as BrandModel;
use App\Model\BrandExtraGame as BrandExtraGameModel;
use Illuminate\Foundation\Http\FormRequest;

interface BrandExtraGameServiceContract
{
	public function store(BrandModel $brand, FormRequest $request);
	public function update(BrandExtraGameModel $extra_game, FormRequest $request);
	public function delete(BrandExtraGameModel $extra_game);
}