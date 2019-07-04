<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-25
 * Time: 17:15
 */
namespace App\Services;

use App\Jobs\CaptureBrandDataJob;
use App\Jobs\CaptureBrandDrawJob;
use App\Jobs\CaptureBrandJackpotJob;
use App\Lib\Mangayo\Contracts\GameDataContract;
use App\Lib\Utils;
use App\Model\Brand;
use App\Services\Contracts\BrandServiceContract;
use Illuminate\Foundation\Http\FormRequest;

class BrandService implements BrandServiceContract
{
	public function store( FormRequest $request )
	{

		dd($request->request);
		/*$refresh_time = Utils::parseToTime($request->get('refresh_time'));

		$code = \Str::lower($request->get('code'));
		$logo = $code .'-logo.'.$request->logo->getClientOriginalExtension();

		$request->logo->move(public_path('images/logos'), $logo);

		$brand = Brand::create([
			'name'  => $request->get('name'),
			'api_code'  => $code,
			'logo' => $logo,
			'status' => Brand::STATUS_IN_SYNC,
			'refresh_data_time' => $refresh_time,
			'owner_id' => $request->user()->id
		]);

		CaptureBrandDataJob::dispatch($brand);
		CaptureBrandJackpotJob::dispatch($brand);

		return $brand;*/
	}

	public function list( $per_page )
	{
		return Brand::query()
			->orderBy('name')
			->get();
	}

	public function fillGameData( Brand $brand )
	{
		try {
			/** @var GameDataContract $gameData */
			$gameData = \LotteryRemoteApi::getGameInfo($brand->api_code);

			if ($gameData->hasError()) {
				$this->errSync($brand, \LotteryRemoteApi::getErrorDescription($gameData->getErrorCode()));
				return;
			}

			$brand->country = $gameData->getCountry();
			$brand->state = $gameData->getState();
			$brand->main_min = $gameData->getMainMin();
			$brand->main_max = $gameData->getMainMax();
			$brand->main_drawn = $gameData->getMainDrawn();

			$brand->bonus_min = $gameData->getBonusMin();
			$brand->bonus_max = $gameData->getBonusMax();
			$brand->bonus_drawn = $gameData->getBonusDrawn();

			$brand->same_balls = $gameData->getSameBalls();
			$brand->digits = $gameData->getDigits();
			$brand->drawn = $gameData->getDrawn();

			if ($gameData->isOption()) {
				$brand->option_desc = $gameData->getOptionDescription();
			}

			$brand->status = Brand::STATUS_SYNCED;
			$brand->save();

			if ($brand->draw->count() == 0) {
				CaptureBrandDrawJob::dispatch($brand);
			}

		} catch (\Exception $e) {
			$this->errSync($brand, $e->getMessage());
		}
	}

	protected function errSync($brand, $message)
	{
		//TODO need log this
		$brand->status = Brand::STATUS_ERR_SYNC;
		$brand->save();
	}
}
