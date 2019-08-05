<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-05
 * Time: 09:57
 */
namespace App\Facades;

use App\Services\Contracts\TicketServiceContract;
use Illuminate\Support\Facades\Facade;

class TicketServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TicketServiceContract::class;
    }

}
