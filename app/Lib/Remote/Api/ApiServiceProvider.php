<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-05
 * Time: 15:21
 */

namespace App\Lib\Remote\Api;

use App\Lib\Remote\Api\Contracts\ApiServiceContract;
use App\Lib\Remote\Api\Services\ApiService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//Contracts mapping
		$this->app->bind('http-client', function () {
			return new Client();
		});

		$this->app->bind(ApiServiceContract::class, ApiService::class);
	}
}