<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-26
 * Time: 10:07
 */

namespace App\Facades\Api;


use App\Services\Api\Contracts\PayoutServiceContract;
use Illuminate\Support\Facades\Facade;

class PayoutFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PayoutServiceContract::class;
    }

}
