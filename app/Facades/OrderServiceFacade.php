<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-29
 * Time: 14:22
 */

namespace App\Facades;

use App\Services\Contracts\OrderServiceContract;
use Illuminate\Support\Facades\Facade;

class OrderServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return OrderServiceContract::class;
    }

}
