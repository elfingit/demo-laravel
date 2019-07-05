<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-05
 * Time: 14:08
 */

namespace App\Facades;

use App\Services\Contracts\BrandCheckDateContract;
use Illuminate\Support\Facades\Facade;

class BrandCheckDateFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return BrandCheckDateContract::class;
	}

}