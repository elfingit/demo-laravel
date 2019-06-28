<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-26
 * Time: 08:58
 */

namespace App\Lib\Mangayo\Api;

use App\Lib\Mangayo\Contracts\GameDataContract;
use Psr\Http\Message\ResponseInterface;

class GameData implements GameDataContract
{
	private $data;

	public static function instanceFromResponse(ResponseInterface $response)
	{
		$data = \GuzzleHttp\json_decode($response->getBody());

		return new GameData($data);
	}

	public function __construct($data)
	{
		$this->data = $data;
	}


	public function hasError()
	{
		return $this->data->error > 0;
	}

	public function getErrorCode()
	{
		return $this->data->error;
	}

	public function getName()
	{
		return $this->data->name;
	}

	public function getCountry()
	{
		return $this->data->country;
	}

	public function getState()
	{
		return $this->data->state;
	}

	public function getMainMin()
	{
		return $this->data->main_min;
	}

	public function getMainMax()
	{
		return $this->data->main_max;
	}

	public function getMainDrawn()
	{
		return $this->data->main_drawn;
	}

	public function getBonusMin()
	{
		return $this->data->bonus_min;
	}

	public function getBonusMax()
	{
		return $this->data->bonus_max;
	}

	public function getBonusDrawn()
	{
		return $this->data->bonus_drawn;
	}

	public function getSameBalls()
	{
		return $this->data->same_balls;
	}

	public function getDigits()
	{
		return $this->data->digits;
	}

	public function getDrawn()
	{
		return $this->data->drawn;
	}

	public function isOption()
	{
		return $this->data->is_option === 'Y';
	}

	public function getOptionDescription()
	{
		return $this->data->option_desc;
	}

}