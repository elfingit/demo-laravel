<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-19
 * Time: 15:03
 */

namespace App\Facades\Api;


use App\Services\Api\Contracts\WithdrawableServiceContract;
use Illuminate\Support\Facades\Facade;

class WithdrawableServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return WithdrawableServiceContract::class;
    }

}
