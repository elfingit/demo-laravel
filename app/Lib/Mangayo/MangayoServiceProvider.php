<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-26
 * Time: 08:08
 */

namespace App\Lib\Mangayo;

use App\Lib\Mangayo\Api\Mangayo;
use App\Lib\Mangayo\Contracts\MangayoApiContract;
use Carbon\Laravel\ServiceProvider;
use GuzzleHttp\Client;

class MangayoServiceProvider extends ServiceProvider
{
	const CONFIG_KEY = 'mangayo-api';

	public function boot()
	{
		$file_name = self::CONFIG_KEY . '.php';

		$configPath = __DIR__ . '/config/' . $file_name;
		if (function_exists('config_path')) {
			$publishPath = config_path($file_name);
		} else {
			$publishPath = base_path('config/' . $file_name);
		}
		$this->publishes([$configPath => $publishPath], 'config');
	}

	public function register()
	{

		$configPath = __DIR__ . '/config/' . self::CONFIG_KEY . '.php';
		$this->mergeConfigFrom($configPath, self::CONFIG_KEY);

		$this->app->bind('mangayo-http-client', function () {
			return new Client();
		});

		$this->app->bind(MangayoApiContract::class, function() {
			return new Mangayo(config(self::CONFIG_KEY));
		});

	}
}