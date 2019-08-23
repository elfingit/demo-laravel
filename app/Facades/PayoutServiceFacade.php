<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-23
 * Time: 10:47
 */

namespace App\Facades;


use App\Services\Contracts\PayoutServiceContract;
use Illuminate\Support\Facades\Facade;

class PayoutServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PayoutServiceContract::class;
    }

}
