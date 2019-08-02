<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-01
 * Time: 10:03
 */
namespace App\Services;

use App\Model\BrandResult as BrandResultModel;
use App\Services\Contracts\WinningsServiceContract;

class WinningsService implements WinningsServiceContract
{
    const CALCULATOR_PREFIX = 'brand_win_calc_';

    public function calculate( BrandResultModel $result )
    {
        $brand = $result->brand;

        if ($brand) {
            $bets = $brand->betsForPlay;

            if ($bets) {

                $calculator = $this->getWinCalculator($brand->api_code);
                $calculator->check($bets);

            } else {
                logs()->warning('Bets not found for brend:' . $brand->api_code, [__CLASS__]);
            }

        } else {
            logs()->warning('Brand not found for result:' . serialize($result), [__CLASS__]);
        }
    }

    protected function getWinCalculator($code)
    {
        return app(self::CALCULATOR_PREFIX . $code);
    }
}
