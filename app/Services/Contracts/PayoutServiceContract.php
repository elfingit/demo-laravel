<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-23
 * Time: 10:46
 */

namespace App\Services\Contracts;


use App\Model\UserPayoutRequest as UserPayoutRequestModel;
use Illuminate\Foundation\Http\FormRequest;

interface PayoutServiceContract
{
    public function list();
    public function getStatuses();

    public function changeStatus(FormRequest $request, UserPayoutRequestModel $payout);
}
