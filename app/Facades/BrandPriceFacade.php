<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-26
 * Time: 17:45
 */

namespace App\Facades;

use App\Services\Contracts\BrandPriceServiceContract;
use Illuminate\Support\Facades\Facade;

class BrandPriceFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return BrandPriceServiceContract::class;
	}

}