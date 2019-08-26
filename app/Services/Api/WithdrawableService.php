<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-19
 * Time: 15:00
 */

namespace App\Services\Api;


use App\Model\User as UserModel;
use App\Model\UserPayoutRequest as UserPayoutRequestModel;
use App\Model\UserWithdrawableBalanceTransaction as UserWithdrawableBalanceTransactionModel;
use App\Services\Api\Contracts\WithdrawableServiceContract;
use Illuminate\Foundation\Http\FormRequest;

class WithdrawableService implements WithdrawableServiceContract
{

    public function approve( UserPayoutRequestModel $payout_request )
    {
        // TODO: Implement approve() method.
    }

    public function decline( UserPayoutRequestModel $payout_request )
    {
        // TODO: Implement decline() method.
    }

}
