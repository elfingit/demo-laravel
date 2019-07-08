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
		return BrandModel::all();
	}
}