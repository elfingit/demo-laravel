<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-26
 * Time: 10:06
 */

namespace App\Services\Api;


use App\Model\User as UserModel;
use App\Model\UserPayoutTransaction as UserPayoutTransactionModel;
use App\Model\UserPayoutRequest as UserPayoutRequestModel;
use App\Model\UserTransaction as UserTransactionModel;
use App\Services\Api\Contracts\PayoutServiceContract;
use Illuminate\Foundation\Http\FormRequest;

class PayoutService implements PayoutServiceContract
{
    public function freeze( FormRequest $request, UserModel $user )
    {
        \DB::beginTransaction();
        try {
            $balance = $user->withdrawable_balance;
            $amount  = $request->get( 'amount' );

            $balance->lockForUpdate();

            $balance->available_amount = $balance->available_amount - $amount;

            $balance->save();

            $requestModel = new UserPayoutRequestModel([
                'user_id'   => $user->id,
                'status'    => UserPayoutRequestModel::STATUS_PENDING,
                'amount'    => $amount,
                'type'      => $request->get('type')
            ]);

            $requestModel->save();

            $transaction = new UserPayoutTransactionModel([
                'transaction_id'    => \Str::random(4).'-'.\Str::random(),
                'amount'            => $amount,
                'notes'             => 'User payout request',
                'request_id'        => $requestModel->id
            ]);

            $transaction->save();

            $uTransaction = new UserTransactionModel( [
                'user_id'          => $user->id,
                'transaction_id'   => $transaction->id,
                'transaction_type' => UserPayoutTransactionModel::class
            ] );

            $uTransaction->save();

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
        }
    }

    public function approve( UserPayoutRequestModel $payout_request )
    {
        // TODO: Implement approve() method.
    }

    public function decline( UserPayoutRequestModel $payout_request )
    {
        // TODO: Implement decline() method.
    }


}
