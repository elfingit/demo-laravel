<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-05
 * Time: 15:27
 */

return [
	'host'      => env('REMOTE_API_HOST', 'localhost'),
	'protocol'  => env('REMOTE_API_PROTOCOL', 'http://'),
	'port'      => env('REMOTE_API_PORT', 3000)
];