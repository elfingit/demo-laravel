<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-28
 * Time: 09:23
 */

namespace App\Lib\Mangayo\Contracts;

interface GameNextDrawContract
{
	public function hasError();

	public function getErrorCode();

	public function getDate();
}