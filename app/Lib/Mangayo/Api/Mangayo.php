<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-26
 * Time: 08:34
 */

namespace App\Lib\Mangayo\Api;

use App\Lib\Mangayo\Contracts\MangayoApiContract;
use GuzzleHttp\Client;

class Mangayo implements MangayoApiContract
{
	const BASE_URL = 'https://www.magayo.com/api/';

	protected $config = [];

	/**
	 * @var Client
	 */
	protected $httpClient = null;

	public function __construct($config)
	{
		$this->config = $config;
		$this->httpClient = app('mangayo-http-client');
	}

	public function getGameInfo( $game_code )
	{
		$url = $this->buildUrl('info.php', ['game' => $game_code]);

		try {
			$response = $this->httpClient->get( $url );
			return GameData::instanceFromResponse($response);

		} catch (\GuzzleHttp\Exception\RequestException $exception) {
			throw new RequestException($exception->getCode() . ':' . $exception->getMessage());
		} catch (\InvalidArgumentException $e) {
			throw new RequestException($e->getMessage());
		}
	}

	public function getNextDrawDate( $game_code )
	{
		$url = $this->buildUrl('next_draw.php', ['game' => $game_code]);

		try {
			$response = $this->httpClient->get( $url );
			return NextDrawData::instanceFromResponse($response);

		} catch (\GuzzleHttp\Exception\RequestException $exception) {
			throw new RequestException($exception->getCode() . ':' . $exception->getMessage());
		} catch (\InvalidArgumentException $e) {
			throw new RequestException($e->getMessage());
		}
	}

	public function getErrorDescription( $error_code )
	{
		$errorsDescription = [
			100 => 'API key not provided',
			101 => 'Invalid API key',
			102 => 'API key not found',
			200 => 'Game not provided',
			201 => 'Invalid game',
			202 => 'Game not found',
			300 => 'Account suspended',
			303 => 'API limit reached'
		];

		return isset($errorsDescription[$error_code]) ? $errorsDescription[$error_code] : 'Unknown error code: ' . $error_code;
	}

	protected function buildUrl($path, array $params)
	{
		$url = self::BASE_URL.$path.'?api_key='.$this->config['api_key'];

		$query = '';

		array_walk($params, function($value, $key) use (&$query) {
			$query .= '&' . $key . '=' . $value;
		});

		return $url . $query;
	}
}