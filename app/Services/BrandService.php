<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-25
 * Time: 17:15
 */
namespace App\Services;

use App\Jobs\CaptureBrandDataJob;
use App\Lib\Utils;
use App\Model\Brand;
use App\Services\Contracts\BrandServiceContract;
use Illuminate\Foundation\Http\FormRequest;

class BrandService implements BrandServiceContract
{
	public function store( FormRequest $request )
	{
		$refresh_time = Utils::parseToTime($request->get('refresh_time'));

		$code = \Str::lower($request->get('code'));
		$logo = $code .'-logo.'.$request->logo->getClientOriginalExtension();

		$request->logo->move(public_path('images/logos'), $logo);

		$brand = Brand::create([
			'name'  => $request->get('name'),
			'api_code'  => $code,
			'logo' => $logo,
			'status' => Brand::STATUS_IN_SYNC,
			'refresh_data_time' => $refresh_time,
			'owner_id' => $request->user()->id
		]);



		CaptureBrandDataJob::dispatch($brand);

		return $brand;
	}
}