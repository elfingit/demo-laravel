<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-01
 * Time: 15:31
 */

namespace App\Facades;

use App\Services\Contracts\BrandJackpotServiceContract;
use Illuminate\Support\Facades\Facade;

class BrandJackpotFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return BrandJackpotServiceContract::class;
	}

}