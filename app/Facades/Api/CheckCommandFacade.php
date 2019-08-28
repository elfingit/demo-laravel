<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-28
 * Time: 07:39
 */

namespace App\Facades\Api;


use App\Services\Api\Contracts\CheckCommandServiceContract;
use Illuminate\Support\Facades\Facade;

class CheckCommandFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CheckCommandServiceContract::class;
    }

}
