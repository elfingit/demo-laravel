<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-01
 * Time: 17:41
 */

namespace App\Lib\Mangayo\Api;

use App\Lib\Mangayo\Contracts\GameResultContract;
use Psr\Http\Message\ResponseInterface;

class GameResultData extends Response implements GameResultContract
{
	public static function instanceFromResponse(ResponseInterface $response)
	{
		$data = \GuzzleHttp\json_decode($response->getBody());

		return new GameResultData($data);
	}

	public function __construct($data)
	{
		$this->data = $data;
	}

	public function getDate()
	{
		return $this->data->draw;
	}

	public function getResults()
	{
		return $this->data->results;
	}

}