<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-08
 * Time: 12:21
 */

namespace App\Services\Api;

use App\Model\Brand as BrandModel;
use App\Services\Api\Contracts\BrandServiceContract;

class BrandService implements BrandServiceContract
{
	public function list()
	{
		return BrandModel::where('status', BrandModel::STATUS_SYNCED);
	}

	public function getBrand( $api_code )
	{
		return BrandModel::where('api_code', $api_code)
		                 ->where('status', BrandModel::STATUS_SYNCED)
		                 ->first();
	}

	public function getResults( $api_code )
	{
		$brand = BrandModel::where('api_code', $api_code)
		                   ->where('status', BrandModel::STATUS_SYNCED)
		                   ->first();

		if (!$brand) {
			return false;
		}

		return $brand->results()
			->orderBy('draw_date', 'desc')
			->get();
	}
}