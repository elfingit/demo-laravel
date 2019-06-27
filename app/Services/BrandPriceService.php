<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-26
 * Time: 17:43
 */

namespace App\Services;

use App\Model\Brand as BrandModel;
use App\Model\BrandPrice;
use App\Services\Contracts\BrandPriceServiceContract;
use Illuminate\Foundation\Http\FormRequest;

class BrandPriceService implements BrandPriceServiceContract
{
	public function store( BrandModel $brand, FormRequest $request )
	{
		$price = new BrandPrice([
			'combination_price' => $request->get('combination_price'),
			'number_shield_price' => $request->get('number_shield_price'),
			'currency'  => $request->get('currency')
		]);

		$brand->prices()->save($price);

		return $price;
	}
}