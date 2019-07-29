<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-29
 * Time: 16:41
 */
namespace App\Facades\Api;

use App\Services\Api\Contracts\OrderServiceContract;
use Illuminate\Support\Facades\Facade;

class OrderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return OrderServiceContract::class;
    }

}
