<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-05
 * Time: 14:04
 */

namespace App\Services\Contracts;

interface BrandCheckDateContract
{
	public function getDates($date);
}