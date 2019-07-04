<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-25
 * Time: 17:15
 */
namespace App\Services;

use App\Model\Brand;
use App\Model\BrandCheckDate;
use App\Services\Contracts\BrandServiceContract;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class BrandService implements BrandServiceContract
{
	public function store( FormRequest $request )
	{
		$code = \Str::lower($request->get('code'));
		$logo = $code .'-logo.'.$request->logo->getClientOriginalExtension();

		$request->logo->move(public_path('images/logos'), $logo);

		$brand = Brand::create([
			'name'  => $request->get('name'),
			'api_code'  => $code,
			'logo' => $logo,
			'jackpot_multiplier' => $request->get('jackpot_multiplier'),
			'number_shield' => $request->get('number_shield'),
			'default_quick_pick' => $this->prepareDefaultQuickPick($request->get('default_quick_pick')),
			'primary_pool' => $request->get('primary_pool'),
			'primary_pool_combination' => $request->get('primary_pool_combination'),
			'special_pool' => $request->get('special_pool'),
			'special_pool_combination' => $request->get('special_pool_combination'),
			'name_of_special_pool' => $request->get('name_of_special_pool'),
			'duration' => $request->get('duration'),
			'subscription' => $request->get('subscription'),
			'jackpot_hut' => $request->get('jackpot_hut'),
			'participation' => $request->get('participation'),
			'extra_game' => $request->get('extra_game'),
			'status' => Brand::STATUS_SYNCED,
			'owner_id' => $request->user()->id
		]);

		$this->storeCheckDates($request, $brand);

		return $brand;
	}

	public function list( $per_page )
	{
		return Brand::query()
			->orderBy('name')
			->get();
	}

	protected function prepareDefaultQuickPick($data) {
		return json_encode(explode(',', $data));
	}

	protected function storeCheckDates(FormRequest $request, Brand $brand)
	{
		$dates = $request->get('result_date');
		$hours = $request->get('hours');
		$minutes = $request->get('minutes');

		foreach ($dates as $key => $date) {
			$carbon = Carbon::parse($date);
			$carbon->hour = $hours[$key];
			$carbon->minute = $minutes[$key];
			$carbon->second = 0;

			$nextDay = new Carbon();
			$nextDay->hour = $hours[$key];
			$nextDay->minute = $minutes[$key];
			$nextDay->second = 0;

			if ($request->get('period') == BrandCheckDate::PERIOD_DAY) {
				$nextDay->addDay();
			} elseif ($request->get('period') == BrandCheckDate::PERIOD_WEEK) {
				$days = $carbon->dayOfWeek - $nextDay->dayOfWeek;
				$nextDay->addDays($days);
				$nextDay->addWeek();
			}

			$brandCheckDate = new BrandCheckDate([
				'check_date' => $carbon,
				'next_check_date' => $nextDay
			]);

			$brand->checkDates()->save($brandCheckDate);
		}
	}
}
