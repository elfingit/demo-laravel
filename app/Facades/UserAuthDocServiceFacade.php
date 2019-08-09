<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-09
 * Time: 11:19
 */
namespace App\Facades;

use App\Services\Contracts\UserAuthDocServiceContract;
use Illuminate\Support\Facades\Facade;

class UserAuthDocServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UserAuthDocServiceContract::class;
    }
}
