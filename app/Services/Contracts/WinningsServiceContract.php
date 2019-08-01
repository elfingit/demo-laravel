<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-01
 * Time: 10:01
 */
namespace App\Services\Contracts;

use App\Model\BrandResult as BrandResultModel;

interface WinningsServiceContract
{
    public function calculate(BrandResultModel $result);
}
