<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-28
 * Time: 10:13
 */

namespace App\Services;

use App\Lib\Mangayo\Contracts\GameNextDrawContract;
use App\Model\Brand as BrandModel;
use App\Model\BrandDraw as BrandDrawModel;
use App\Services\Contracts\BrandDrawServiceContract;

class BrandDrawService implements BrandDrawServiceContract
{
	public function fetchDraw( BrandModel $brand )
	{
		try {
			/** @var GameNextDrawContract $drawData */
			$drawData = \LotteryRemoteApi::getNextDrawDate($brand->api_code);

			if ($drawData->hasError()) {
				$this->errSync(\LotteryRemoteApi::getErrorDescription($drawData->getErrorCode()));

				return;
			}

			$date = $drawData->getDate();
			
			$bDraw = BrandDrawModel::isExists($date)->first();

			if ($bDraw) {
				//Already have record for this date
				$this->errSync('Draw already exists');
				return;
			}

			$draw = new BrandDrawModel([
				'draw_date' => $date,
				'status'    => BrandDrawModel::STATUS_NEW
			]);

			$brand->draws()->save($draw);

			return $draw;

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