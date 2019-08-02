<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-01
 * Time: 10:04
 */
namespace App\Facades;

use App\Services\Contracts\WinningsServiceContract;
use Illuminate\Support\Facades\Facade;

class WinningsServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return WinningsServiceContract::class;
    }

}
