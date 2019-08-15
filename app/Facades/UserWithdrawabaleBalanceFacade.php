<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-15
 * Time: 14:24
 */

namespace App\Facades;


use App\Services\Contracts\UserWithdrawableBalanceServiceContract;
use Illuminate\Support\Facades\Facade;

class UserWithdrawabaleBalanceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UserWithdrawableBalanceServiceContract::class;
    }

}
