<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-25
 * Time: 10:00
 */

namespace App\Facades;

use App\Services\Contracts\BrandExtraGameServiceContract;
use Illuminate\Support\Facades\Facade;

class BrandExtraGameFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return BrandExtraGameServiceContract::class;
	}

}