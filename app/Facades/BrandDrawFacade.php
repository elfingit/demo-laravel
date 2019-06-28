<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-28
 * Time: 11:08
 */

namespace App\Facades;

use App\Services\Contracts\BrandDrawServiceContract;
use Illuminate\Support\Facades\Facade;

class BrandDrawFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return BrandDrawServiceContract::class;
	}

}