<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-26
 * Time: 17:42
 */

namespace App\Services\Contracts;

use App\Model\Brand as BrandModel;
use Illuminate\Foundation\Http\FormRequest;

interface BrandPriceServiceContract
{
	public function store(BrandModel $brand, FormRequest $request);
}