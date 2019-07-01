<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-01
 * Time: 15:40
 */
namespace App\Lib\Mangayo\Contracts;

interface GameJackpotContract
{
	public function hasError();

	public function getErrorCode();

	public function getDate();

	public function getCurrency();

	public function getJackpot();
}