<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-19
 * Time: 12:51
 */

namespace App\Services\Api\Contracts;


use App\Model\User as UserModel;
use App\Model\UserPayoutRequest as UserPayoutRequestModel;
use Illuminate\Foundation\Http\FormRequest;

interface WithdrawableServiceContract
{
    public function store(FormRequest $request, UserModel $user);
    public function approve(UserPayoutRequestModel $payout_request);
    public function decline(UserPayoutRequestModel $payout_request);
}
