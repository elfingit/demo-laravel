<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-25
 * Time: 17:15
 */
namespace App\Services;

use App\Model\Brand as BrandModel;
use App\Model\BrandCheckDate as BrandCheckDateModel;
use App\Services\Contracts\BrandServiceContract;
use App\Services\Exceptions\BrandResultExistsException;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Psr\Http\Message\ResponseInterface;

class BrandService implements BrandServiceContract
{
	private $fields = [
		'name', 'jackpot_multiplier', 'number_shield',
		'primary_pool', 'primary_pool_combination', 'special_pool',
		'special_pool_combination', 'name_of_special_pool', 'duration',
		'subscription', 'jackpot_hut', 'participation', 'extra_game',
		'tickets_count'
	];

	public function store( FormRequest $request )
	{
		$code = $this->prepareCode($request->get('code'));

		$logo = $this->uploadLogo($code, $request);

		$createData = $request->only($this->fields);

		$createData['api_code'] = $code;
		$createData['logo'] = $logo;
		$createData['status'] = BrandModel::STATUS_SYNCED;
		$createData['owner_id'] = $request->user()->id;
		$createData['default_quick_pick'] = $this->prepareDefaultQuickPick($request->get('default_quick_pick'));

		$brand = BrandModel::create($createData);

		$this->storeCheckDates($request, $brand);

		return $brand;
	}

	public function update( FormRequest $request, BrandModel $brand )
	{
		$updateData = $request->only($this->fields);
		$code = $this->prepareCode($request->get('code'));

		if (isset($request->logo)) {
			$logo = $this->uploadLogo($code, $request);
			$updateData['logo'] = $logo;
		}

		$updateData['api_code'] = $code;
		$updateData['status'] = BrandModel::STATUS_SYNCED;
		$updateData['owner_id'] = $request->user()->id;
		$updateData['default_quick_pick'] = $this->prepareDefaultQuickPick($request->get('default_quick_pick'));

		$brand->update($updateData);

		$this->clearCheckDates($brand);
		$this->storeCheckDates($request, $brand);
	}

	public function list( $per_page )
	{
		return BrandModel::query()
			->orderBy('name')
			->get();
	}

	public function fetchResult( BrandCheckDateModel $check_date )
	{
		try {
			/** @var ResponseInterface $result */
			$result = \RemoteApi::fetchResult( $check_date->brand->api_code );
			$data = json_decode( $result->getBody() );

			$result = \BrandResult::store($data, $check_date->brand);

			\BrandCheckDate::moveResultDates($check_date);

		} catch (BrandResultExistsException $e) {

			//Already exists hmmm. Move to the next date of check
			\BrandCheckDate::moveResultDates($check_date);

			$this->logErr($e->getMessage());
		} catch (\Exception $exception) {
			$this->logErr($exception->getMessage() . $exception->getTraceAsString());
		}
	}

	protected function prepareCode($code)
	{
		return \Str::lower($code);
	}

	protected function uploadLogo($code, $request)
	{
		$logo = $code .'-logo.'.$request->logo->getClientOriginalExtension();

		$request->logo->move(public_path('images/logos'), $logo);

		return $logo;
	}

	protected function prepareDefaultQuickPick($data)
	{
		return explode(',', $data);
	}

	protected function clearCheckDates(BrandModel $brand)
	{
		$brand->checkDates()->delete();
	}

	protected function storeCheckDates(FormRequest $request, BrandModel $brand)
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

			if ($request->get('period') == BrandCheckDateModel::PERIOD_DAY) {
				$nextDay->addDay();
			} elseif ($request->get('period') == BrandCheckDateModel::PERIOD_WEEK) {
				$days = $carbon->dayOfWeek - $nextDay->dayOfWeek;
				$nextDay->addDays($days);
				$nextDay->addWeek();
			}

			$brandCheckDate = new BrandCheckDateModel([
				'check_date' => $carbon,
				'next_check_date' => $nextDay,
				'period'    => $request->get('period')
			]);

			$brand->checkDates()->save($brandCheckDate);
		}
	}

	protected function logErr($message)
	{
		//TODO log this
		logger($message);
	}
}
