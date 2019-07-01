<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-01
 * Time: 15:24
 */
namespace App\Services;

use App\Lib\Mangayo\Contracts\GameJackpotContract;
use App\Model\Brand as BrandModel;
use App\Services\Contracts\BrandJackpotServiceContract;
use App\Model\BrandJackpot as BrandJackpotModel;

class BrandJackpotService implements BrandJackpotServiceContract
{
	public function fetchJackpot( BrandModel $brand )
	{
		try {
			/** @var GameJackpotContract $jackpotData */
			$jackpotData = \LotteryRemoteApi::getJackpotData($brand->api_code);

			if ($jackpotData->hasError()) {
				$this->errSync(\LotteryRemoteApi::getErrorDescription($jackpotData->getErrorCode()));

				return;
			}

			$date = $jackpotData->getDate();

			$bJackpot = BrandJackpotModel::isExists($date)->first();

			if ($bJackpot) {
				$this->errSync('Jackpot already exists');
				return;
			}

			$jackpot = new BrandJackpotModel([
				'next_draw' => $date,
				'currency'  => $jackpotData->getCurrency(),
				'jackpot'   => $jackpotData->getJackpot()
			]);

			$brand->jackpots()->save($jackpot);


			return $jackpot;

		} catch (\Exception $e) {

			$this->errSync($e->getMessage());

		}
	}

	protected function errSync($message)
	{
		//TODO need log this
		logger($message);
	}

}