<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-05
 * Time: 16:58
 */

namespace App\Services\Contracts;

use App\Model\Brand as BrandModel;
use App\Model\BrandResult as BrandResultModel;

interface BrandResultContract
{
	public function store($data, BrandModel $brand);

	public function recheckJackPot(BrandResultModel $result);
}
