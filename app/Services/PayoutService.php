<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-23
 * Time: 10:47
 */

namespace App\Services;


use App\Model\UserPayoutRequest as UserPayoutRequestModel;
use App\Services\Contracts\PayoutServiceContract;

class PayoutService implements PayoutServiceContract
{
    public function list()
    {
        return UserPayoutRequestModel::query()
            ->orderBy('id', 'DESC')
            ->paginate();
    }

}
