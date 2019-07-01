<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-01
 * Time: 15:41
 */

namespace App\Lib\Mangayo\Api;

use App\Lib\Mangayo\Contracts\GameJackpotContract;
use Psr\Http\Message\ResponseInterface;

class JackpotData extends Response implements GameJackpotContract
{

	public static function instanceFromResponse(ResponseInterface $response)
	{
		$data = \GuzzleHttp\json_decode($response->getBody());

		return new JackpotData($data);
	}

	public function __construct($data)
	{
		$this->data = $data;
	}

	public function getDate()
	{
		return $this->data->next_draw;
	}

	public function getCurrency()
	{
		return $this->data->currency;
	}

	public function getJackpot()
	{
		return $this->data->jackpot;
	}

}