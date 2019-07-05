<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-05
 * Time: 16:09
 */

namespace App\Lib\Remote\Api\Facades;

use App\Lib\Remote\Api\Contracts\ApiServiceContract;
use Illuminate\Support\Facades\Facade;

class RemoteApiFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return ApiServiceContract::class;
	}

}