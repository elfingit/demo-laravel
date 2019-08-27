<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-27
 * Time: 17:17
 */

namespace App\Facades;


use App\Services\Contracts\RemoteSystemCommandContract;
use Illuminate\Support\Facades\Facade;

class RemoteSystemCommandFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RemoteSystemCommandContract::class;
    }

}
