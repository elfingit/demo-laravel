<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-05
 * Time: 15:17
 */

namespace App\Lib\Remote\Api\Services;

use App\Lib\Remote\Api\Contracts\ApiServiceContract;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class ApiService implements ApiServiceContract
{
	/**
	 * @var Client
	 */
	protected $httpClient;
	protected $config;

	public function __construct()
	{
		$this->httpClient = app('http-client');
		$this->config = config('remote-api');
	}


	public function fetchResult( $game_code )
	{
		$url = $this->getGameUrl($game_code);

		return $this->httpClient->get($url, [
            RequestOptions::TIMEOUT => 60
        ]);
	}

	protected function getGameUrl($game_code)
	{
		return $this->config['protocol'] . $this->config['host'] .':'. $this->config['port'] . '/api/game/' . $game_code;
	}
}
