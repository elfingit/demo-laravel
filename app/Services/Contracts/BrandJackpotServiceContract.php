<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-01
 * Time: 15:22
 */

namespace App\Services\Contracts;

use App\Model\Brand as BrandModel;

interface BrandJackpotServiceContract
{
	public function fetchJackpot(BrandModel $brand);
}