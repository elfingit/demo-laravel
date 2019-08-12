<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-12
 * Time: 16:22
 */

namespace App\Services\Api;


use App\Services\Api\Contracts\BetServiceContract;

class BetService implements BetServiceContract
{
    public function listOfAuthUser()
    {
        $user = \Auth::user();

        return $user->bets()->paginate(25);
    }

}
