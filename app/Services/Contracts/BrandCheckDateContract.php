<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-05
 * Time: 14:04
 */

namespace App\Services\Contracts;

use App\Model\BrandCheckDate as BrandCheckDateModel;

interface BrandCheckDateContract
{
	public function getDates($date);

	public function moveResultDates(BrandCheckDateModel $brand_check_date);
}