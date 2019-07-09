<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-09
 * Time: 11:38
 */
namespace App\Facades;

use App\Services\Contracts\LeadServiceContract;
use Illuminate\Support\Facades\Facade;

class LeadFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return LeadServiceContract::class;
	}

}