<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-28
 * Time: 09:50
 */

namespace App\Services\Contracts;

use App\Lib\Mangayo\Contracts\GameNextDrawContract;
use App\Model\Brand as BrandModel;

interface BrandDrawServiceContract
{
	public function fetchDraw(BrandModel $brand);
	//public function store(GameNextDrawContract $nextDraw, BrandModel $brand);
}