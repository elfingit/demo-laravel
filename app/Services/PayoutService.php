<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-23
 * Time: 10:47
 */

namespace App\Services;

use App\Model\UserAvailableBalanceTransaction as UserAvailableBalanceTransactionModel;
use App\Model\UserPayoutRequest as UserPayoutRequestModel;
use App\Model\UserTransaction as UserTransactionModel;
use App\Model\UserWithdrawableBalanceTransaction as UserWithdrawableBalanceTransactionModel;
use App\Services\Contracts\PayoutServiceContract;
use Illuminate\Foundation\Http\FormRequest;

class PayoutService implements PayoutServiceContract
{
    public function list()
    {
        return UserPayoutRequestModel::query()
            ->orderBy('id', 'DESC')
            ->paginate();
    }

    public function getStatuses()
    {
        return [
            UserPayoutRequestModel::STATUS_PENDING => 'Pending',
            UserPayoutRequestModel::STATUS_APPROVED => 'Approved',
            UserPayoutRequestModel::STATUS_DECLINED => 'Declined',
        ];
    }

    public function changeStatus( FormRequest $request, UserPayoutRequestModel $payout )
    {
        $newStatus = $request->get('status');

        if ($newStatus == UserPayoutRequestModel::STATUS_APPROVED) {
            $this->approvePayout($payout);
        } elseif ($newStatus == UserPayoutRequestModel::STATUS_DECLINED) {
            $this->rejectPayout($payout);
        }
    }

    protected function approvePayout(UserPayoutRequestModel $payout)
    {
        if ($payout->type == UserPayoutRequestModel::TYPE_INTERNAL) {
            try {
                \DB::beginTransaction();

                $balance = $payout->user->available_balance;
                $balance->lockForUpdate();

                $balance->amount = $balance->amount + $payout->amount;
                $balance->save();

                $transaction = new UserAvailableBalanceTransactionModel([
                    'transaction_id'    => \Str::random(4) . '-' . \Str::random(),
                    'amount'            => $payout->amount,
                    'notes'             => 'Payout ID ' . $payout->id,
                    'available_balance_id' => $balance->id
                ]);

                $transaction->save();

                $uTrans = new UserTransactionModel([
                    'user_id'   => $payout->user->id,
                    'transaction_id'    => $transaction->id,
                    'transaction_type' => UserAvailableBalanceTransactionModel::class
                ]);

                $uTrans->save();

                $payout->status = UserPayoutRequestModel::STATUS_APPROVED;
                $payout->save();

                \DB::commit();

            } catch (\Exception $e) {
                \DB::rollBack();
            }
        } else {
            $payout->status = UserPayoutRequestModel::STATUS_APPROVED;
            $payout->save();
        }
    }

    protected function rejectPayout(UserPayoutRequestModel $payout)
    {
        try {
            \DB::beginTransaction();

            $balance = $payout->user->withdrawable_balance;
            $balance->lockForUpdate();

            $balance->available_amount = $balance->available_amount + $payout->amount;

            $balance->save();

            $transaction = new UserWithdrawableBalanceTransactionModel([
                'transaction_id'    => \Str::random(4) . '-' . \Str::random(),
                'amount'            => $payout->amount,
                'notes'             => 'Reject Payout ID ' . $payout->id,
                'balance_id' => $balance->id,
                'status'            => UserWithdrawableBalanceTransactionModel::STATUS_AUTH
            ]);

            $transaction->save();

            $uTrans = new UserTransactionModel([
                'user_id'   => $payout->user->id,
                'transaction_id'    => $transaction->id,
                'transaction_type' => UserWithdrawableBalanceTransactionModel::class
            ]);

            $uTrans->save();

            $payout->status = UserPayoutRequestModel::STATUS_DECLINED;
            $payout->save();

            \DB::commit();

        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            \DB::rollBack();
        }
    }
}
