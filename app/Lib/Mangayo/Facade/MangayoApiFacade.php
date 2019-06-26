<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-26
 * Time: 08:41
 */

namespace App\Lib\Mangayo\Facade;

use App\Lib\Mangayo\Contracts\MangayoApiContract;
use Illuminate\Support\Facades\Facade;

class MangayoApiFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return MangayoApiContract::class;
	}

}