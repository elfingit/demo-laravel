<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-08
 * Time: 12:22
 */

namespace App\Facades\Api;

use App\Services\Api\Contracts\BrandServiceContract;
use Illuminate\Support\Facades\Facade;

class BrandFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return BrandServiceContract::class;
	}

}