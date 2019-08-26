<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-26
 * Time: 10:02
 */

namespace App\Services\Api\Contracts;


use App\Model\User as UserModel;
use App\Model\UserPayoutRequest as UserPayoutRequestModel;
use Illuminate\Foundation\Http\FormRequest;

interface PayoutServiceContract
{
    public function freeze(FormRequest $request, UserModel $user);
    public function approve(UserPayoutRequestModel $payout_request);
    public function decline(UserPayoutRequestModel $payout_request);
}
