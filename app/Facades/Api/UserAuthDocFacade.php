<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-12
 * Time: 12:55
 */

namespace App\Facades\Api;

use App\Services\Api\Contracts\UserAuthDocServiceContract;
use Illuminate\Support\Facades\Facade;

class UserAuthDocFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UserAuthDocServiceContract::class;
    }

}
