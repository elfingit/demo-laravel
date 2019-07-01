<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-26
 * Time: 17:43
 */

namespace App\Services;

use App\Model\Brand as BrandModel;
use App\Model\BrandPrice as BrandPriceModel;
use App\Services\Contracts\BrandPriceServiceContract;
use Illuminate\Foundation\Http\FormRequest;

class BrandPriceService implements BrandPriceServiceContract
{
	public function store( BrandModel $brand, FormRequest $request )
	{
		$price = new BrandPriceModel([
			'combination_price' => $request->get('combination_price'),
			'number_shield_price' => $request->get('number_shield_price'),
			'currency'  => $request->get('currency')
		]);

		$brand->prices()->save($price);

		return $price;
	}

	public function list(BrandModel $brand)
	{
		return $brand->prices()->orderBy('id')->get();
	}

	public function update( BrandPriceModel $brand_price, FormRequest $request )
	{
		$brand_price->combination_price = $request->get('combination_price');
		$brand_price->number_shield_price = $request->get('number_shield_price');
		$brand_price->currency = $request->get('currency');

		$brand_price->save();

		return $brand_price;
	}

	public function delete( BrandModel $brand, BrandPriceModel $brand_price )
	{
		//You are must not delete last price
		if ($brand->prices->count() == 1) {
			abort(406, 'You are can\'t delete last price in brand');
		}

		$brand_price->delete();
	}
}