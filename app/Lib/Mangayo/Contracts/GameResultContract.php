<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-01
 * Time: 17:28
 */

namespace App\Lib\Mangayo\Contracts;

interface GameResultContract
{

	public function hasError();
	public function getErrorCode();

	public function getDate();
	public function getResults();
}