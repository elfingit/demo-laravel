<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-12
 * Time: 11:59
 */

namespace Tests\Unit;

use App\Lib\Utils;
use Carbon\Carbon;
use Tests\TestCase;

class NextDateTest extends TestCase
{
	public function testNextWeekDate()
	{
		$carbon = Carbon::parse('2019-07-06');
		$carbon->hour = '15';
		$carbon->minute = '30';
		$carbon->second = 0;

		$nextDay = Carbon::parse('2019-07-12');
		$nextDay->hour = '15';
		$nextDay->minute = '30';
		$nextDay->second = 0;

		$result = Utils::getNextDate($carbon, $nextDay, 2);

		$this->assertSame('2019-07-13 15:30', $result->format('Y-m-d H:i'));

		$carbon = Carbon::parse('2019-07-05');
		$carbon->hour = '15';
		$carbon->minute = '30';
		$carbon->second = 0;

		$nextDay = Carbon::parse('2019-07-12');
		$nextDay->hour = '15';
		$nextDay->minute = '30';
		$nextDay->second = 0;

		$result = Utils::getNextDate($carbon, $nextDay, 2);

		$this->assertSame('2019-07-12 15:30', $result->format('Y-m-d H:i'));

		$carbon = Carbon::parse('2019-07-02');
		$carbon->hour = '15';
		$carbon->minute = '30';
		$carbon->second = 0;

		$nextDay = Carbon::parse('2019-07-12');
		$nextDay->hour = '15';
		$nextDay->minute = '30';
		$nextDay->second = 0;

		$result = Utils::getNextDate($carbon, $nextDay, 2);

		$this->assertSame('2019-07-16 15:30', $result->format('Y-m-d H:i'));
	}
}