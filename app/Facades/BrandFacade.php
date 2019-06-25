<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-25
 * Time: 17:26
 */

namespace App\Facades;

use App\Services\Contracts\BrandServiceContract;
use Illuminate\Support\Facades\Facade;

class BrandFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return BrandServiceContract::class;
	}

}