<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-26
 * Time: 08:32
 */

namespace App\Lib\Mangayo\Contracts;

use App\Lib\Mangayo\Api\RequestException;

interface MangayoApiContract
{
	/**
	 * @param string $game_code
	 *
	 * @return GameDataContract
	 * @throws RequestException
	 */
	public function getGameInfo($game_code);

	/**
	 * @param $error_code
	 *
	 * @return string
	 */
	public function getErrorDescription($error_code);

	/**
	 * @param string $game_code
	 *
	 * @return GameNextDrawContract
	 * @throws RequestException
	 */
	public function getNextDrawDate($game_code);
}