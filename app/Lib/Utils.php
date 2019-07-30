<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-26
 * Time: 07:25
 */

namespace App\Lib;

use App\Model\Brand as BrandModel;
use App\Model\BrandCheckDate as BrandCheckDateModel;
use Carbon\Carbon;

class Utils
{
	public static function parseToTime($string)
	{
		$map = [
			'd' => 'days',
			'h' => 'hours',
			'm' => 'minutes',
			's' => 'seconds'
		];

		$matches = [];

		preg_match_all('/([0-9]+)\s*((d|h|m|s)+)/', $string, $matches);

		list($ignore, $digits, $letters) = $matches;

		$keys = array_map(function($letter) use ($map) {
			return $map[$letter];
		}, $letters);

		$result = array_combine($keys, $digits);

		$time = 0;

		array_walk($result, function ($val, $key) use (&$time) {

			switch ($key) {
				case 'days':
					$time += $val * 24 * 60 * 60;
					break;

				case 'hours':
					$time += $val * 60 * 60;
					break;

				case 'minutes':
					$time += $val * 60;
					break;

				case 'seconds':
					$time += $val;
					break;
			}

		});

		return $time;
	}

	/**
	 * @param Carbon $date
	 * @param Carbon $today
	 * @param int $period
	 */
	public static function getNextDate($date, $today, $period)
	{
		if ($period == BrandCheckDateModel::PERIOD_DAY) {
			$today->addDay();
			return $today;
		}


		if ($period == BrandCheckDateModel::PERIOD_WEEK) {
			$days = $date->dayOfWeek - $today->dayOfWeek;

			$today->addDays($days);

			if ($days < 0) {
				$today->addWeek();
			}

			return $today;
		}

	}

	public static function getDrawDate($checkDate, $period)
    {
        $today = Carbon::now();

        if ($today->isAfter($checkDate)) {
            return Utils::getNextDate($checkDate, $today, $period);
        }

        return $checkDate;
    }

	public static function calculateLine(BrandModel $brand, $line)
    {
        return $brand->prices[0]->combination_price;
    }

    public static function calculateNumberShield(BrandModel $brand)
    {
        return $brand->prices[0]->number_shield_price;
    }

    public static function calculateExtraGame(BrandModel $brand, $extra_game_name)
    {
        $game = $brand->extra_games()->scopeBySystemName($extra_game_name);

        if (!$game) {
            return 0.0;
        }

        return $game->game_price;
    }
}
