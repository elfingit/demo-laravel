<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-28
 * Time: 09:28
 */

namespace App\Lib\Mangayo\Api;

use App\Lib\Mangayo\Contracts\GameNextDrawContract;
use Psr\Http\Message\ResponseInterface;

class NextDrawData extends Response implements GameNextDrawContract
{
	public static function instanceFromResponse(ResponseInterface $response)
	{
		$data = \GuzzleHttp\json_decode($response->getBody());

		return new NextDrawData($data);
	}

	public function __construct($data)
	{
		$this->data = $data;
	}

	public function getDate()
	{
		// TODO: Implement getDate() method.
	}
}