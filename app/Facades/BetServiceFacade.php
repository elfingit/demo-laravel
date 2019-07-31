<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-31
 * Time: 17:51
 */
namespace App\Facades;

use App\Services\Contracts\BetServiceContract;
use Illuminate\Support\Facades\Facade;

class BetServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return BetServiceContract::class;
    }

}
