<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-12
 * Time: 16:26
 */

namespace App\Facades\Api;


use App\Services\Api\Contracts\BetServiceContract;
use Illuminate\Support\Facades\Facade;

class BetFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return BetServiceContract::class;
    }

}
