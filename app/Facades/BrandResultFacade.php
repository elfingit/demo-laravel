<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-05
 * Time: 17:01
 */

namespace App\Facades;

use App\Services\Contracts\BrandResultContract;
use Illuminate\Support\Facades\Facade;

class BrandResultFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return BrandResultContract::class;
	}

}