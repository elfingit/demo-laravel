<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-01
 * Time: 10:03
 */
namespace App\Services;

use App\Lib\Loggers\WinCheckLogger;
use App\Model\BrandResult as BrandResultModel;
use App\Services\Contracts\WinningsServiceContract;

class WinningsService implements WinningsServiceContract
{
    /**
     * @var \Monolog\Logger
     */
    protected $logger;

    const CALCULATOR_PREFIX = 'brand_win_calc_';

    public function __construct()
    {
        $this->logger = WinCheckLogger::getLogger();
    }


    public function calculate( BrandResultModel $result )
    {
        $brand = $result->brand;

        if ($brand) {
            $this->logger->info('Got brand:' . $brand->api_code, [__CLASS__]);
            $this->logger->info($result->draw_date);
            $this->logger->info($brand->betsForPlay($result->draw_date)->toSql());
            $bets = $brand->betsForPlay($result->draw_date)->get();

            if ($bets) {
                $this->logger->info('Got brand:' . $brand->api_code, [__CLASS__]);
                $calculator = $this->getWinCalculator($brand->api_code);
                if ($calculator) {
                    $calculator->check($bets, $result);
                } else {
                    $this->logger->error('Calculator for ' . $brand->api_code. ' not found');
                }


            } else {
                $this->logger->warning('Bets not found for brend:' . $brand->api_code, [__CLASS__]);
            }

        } else {
            $this->logger->warning('Brand not found for result:' . serialize($result), [__CLASS__]);
        }
    }

    protected function getWinCalculator($code)
    {
        try {
            return app( self::CALCULATOR_PREFIX . $code );
        } catch (\Exception $e) {
            $this->logger->error('Got error while trying calculator ' . $code, [__CLASS__]);
            $this->logger->error($e->getMessage(), [__CLASS__]);
        }

        return null;
    }
}
