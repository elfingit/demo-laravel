<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-26
 * Time: 17:42
 */

namespace App\Services\Contracts;

use App\Model\Brand as BrandModel;
use App\Model\BrandPrice as BrandPriceModel;
use Illuminate\Foundation\Http\FormRequest;

interface BrandPriceServiceContract
{
	public function store(BrandModel $brand, FormRequest $request);
	public function list(BrandModel $brand);
	public function update(BrandPriceModel $brand_price, FormRequest $request);
	public function delete(BrandModel $brand, BrandPriceModel $brand_price);
}