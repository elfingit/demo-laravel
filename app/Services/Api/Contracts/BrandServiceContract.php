<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-08
 * Time: 12:20
 */

namespace App\Services\Api\Contracts;

interface BrandServiceContract
{
	public function list();
	public function getBrand($api_code);
}