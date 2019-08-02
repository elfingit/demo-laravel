<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-01
 * Time: 10:40
 */
namespace App\Lib\Calculators;

use App\Model\BrandResult as BrandResultModel;
use Illuminate\Support\Collection;

interface CalculatorContract
{
    public function check(Collection $bets, BrandResultModel $result);
}
