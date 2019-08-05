<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-05
 * Time: 09:24
 */
namespace App\Lib\Calculators;

use App\Lib\Loggers\WinCheckLogger;

abstract  class AbstractCalculator implements CalculatorContract
{
    const WIN = 1;
    const NOT_WIN = 0;

    /**
     * @var \Monolog\Logger
     */
    protected $logger;

    public function __construct()
    {
        $this->logger = WinCheckLogger::getLogger();
    }
}
