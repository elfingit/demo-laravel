<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-02
 * Time: 16:39
 */
namespace App\Lib\Loggers;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class WinCheckLogger
{
    /**
     * @return Logger
     */
    public static function getLogger()
    {
        $logger = new Logger('win-check-logger');
        $logger->pushHandler(new RotatingFileHandler(storage_path('logs/win_check.log')));

        return  $logger;
    }
}
