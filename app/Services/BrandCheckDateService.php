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
use Carbon\Carbon;

class BrandCheckDateService implements BrandCheckDateContract
{
	public function getDates( $date )
	{
		return BrandCheckDateModel::readyForCheck($date)->get();
	}

	public function moveResultDates( BrandCheckDateModel $brand_check_date )
	{
		$brand_check_date->last_check_date = Carbon::today();
		$nextDate = $brand_check_date->next_check_date;

		if ($brand_check_date->period == BrandCheckDateModel::PERIOD_DAY) {
			$nextDate->addDay();
		} elseif ($brand_check_date->period == BrandCheckDateModel::PERIOD_WEEK) {
			$nextDate->addWeek();
		}

		$brand_check_date->next_check_date = $nextDate;
		$brand_check_date->save();

		return $brand_check_date;
	}
}