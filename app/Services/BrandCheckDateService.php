<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-05
 * Time: 14:05
 */

namespace App\Services;

use App\Model\BrandCheckDate as BrandCheckDateModel;
use App\Services\Contracts\BrandCheckDateContract;

class BrandCheckDateService implements BrandCheckDateContract
{
	public function getDates( $date )
	{
		return BrandCheckDateModel::readyForCheck($date)->get();
	}

}