<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-29
 * Time: 17:40
 */
namespace App\Facades\Api;

use Illuminate\Support\Facades\Facade;

class LoggerFacade extends Facade
{
    const BIND_KEY = 'api-logger';

    protected static function getFacadeAccessor()
    {
        return self::BIND_KEY;
    }

}
