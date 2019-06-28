<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-28
 * Time: 09:25
 */
namespace App\Lib\Mangayo\Api;

abstract class Response
{
	protected $data;

	public function hasError()
	{
		return $this->data->error > 0;
	}

	public function getErrorCode()
	{
		return $this->data->error;
	}
}