<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-09
 * Time: 07:19
 */

namespace App\Facades\Api;

use App\Services\Api\Contracts\LeadServiceContract;
use Illuminate\Support\Facades\Facade;

class LeadFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return LeadServiceContract::class;
	}

}