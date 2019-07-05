<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-05
 * Time: 15:16
 */

namespace App\Lib\Remote\Api\Contracts;

use Psr\Http\Message\ResponseInterface;

interface ApiServiceContract
{
	/**
	 * @param $game_code
	 *
	 * @return ResponseInterface
	 */
	public function fetchResult($game_code);
}