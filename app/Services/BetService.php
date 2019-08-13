<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-31
 * Time: 17:48
 */
namespace App\Services;

use App\Events\BetChangeStatusEvent;
use App\Lib\Query\Criteria;
use App\Model\Bet as BetModel;
use App\Model\User as UserModel;
use App\Services\Contracts\BetServiceContract;
use Illuminate\Http\Request;

class BetService implements BetServiceContract
{
    public function changeBetStatus(BetModel $bet, $status )
    {
        $bet->status = $status;
        $bet->save();

        event(new BetChangeStatusEvent($bet));

        return $bet;
    }

    public function list( Request $request )
    {
        $criteria = new Criteria($request);
        $criteria->attachQuery(BetModel::query());

        $criteria->where('order_id', 'order_id');
        $criteria->where('status', 'status');
        $criteria->where('brand', 'brand_id');

        return $criteria->paginate(25);
    }

    public function getStatuses(BetModel $bet = null)
    {
        $statuses = [
            BetModel::STATUS_PAID => 'Paid',
            BetModel::STATUS_WAITING_DRAW => 'Waiting draw',
            BetModel::STATUS_PLAYED => 'Played',
            BetModel::STATUS_WIN => 'Win',
            BetModel::STATUS_REFUND => 'Refund',
            BetModel::STATUS_AUTH_PENDING => 'Authorization pending',
            BetModel::STATUS_NOT_AUTH => 'Not authorized',
            BetModel::STATUS_PAYOUT_PENDING => 'Payout pending',
            BetModel::STATUS_PAYOUT => 'Payout',
            BetModel::STATUS_CLOSED => 'Closed',
            BetModel::STATUS_CANCELLED => 'Cancelled'
        ];

        if (is_null($bet)) {
            return $statuses;
        }

        $statuses = array_filter($statuses, function ($status, $key) use ($bet) {

            if ($bet->status == BetModel::STATUS_WAITING_DRAW && $key == BetModel::STATUS_PAID ) {
                return false;
            }

            if ($bet->status == BetModel::STATUS_REFUND && $key != BetModel::STATUS_CANCELLED && $key != BetModel::STATUS_REFUND) {
                return false;
            }

            if ($bet->status == BetModel::STATUS_CANCELLED && $key != BetModel::STATUS_CANCELLED) {
                return false;
            }

            if ($bet->status == BetModel::STATUS_PLAYED && (
                    $key == BetModel::STATUS_PAID
                    || $key == BetModel::STATUS_WAITING_DRAW
                    || $key == BetModel::STATUS_WIN
                    || $key == BetModel::STATUS_REFUND
                    || $key == BetModel::STATUS_AUTH_PENDING
                    || $key == BetModel::STATUS_NOT_AUTH
                    || $key == BetModel::STATUS_PAYOUT_PENDING
                    || $key == BetModel::STATUS_PAYOUT
                    || $key == BetModel::STATUS_CANCELLED
                )) {
                return false;
            }

            if ($bet->status == BetModel::STATUS_WIN && (
                    $key == BetModel::STATUS_PAID
                    || $key == BetModel::STATUS_WAITING_DRAW
                    || $key == BetModel::STATUS_PLAYED
                    || $key == BetModel::STATUS_REFUND
                )) {

                return false;
            }

            if ($bet->status == BetModel::STATUS_AUTH_PENDING && (
                    $key == BetModel::STATUS_PAID
                    || $key == BetModel::STATUS_WAITING_DRAW
                    || $key == BetModel::STATUS_PLAYED
                    || $key == BetModel::STATUS_REFUND
                    || $key == BetModel::STATUS_WIN
                )) {

                return false;
            }

            if ($bet->status == BetModel::STATUS_NOT_AUTH && (
                    $key == BetModel::STATUS_PAID
                    || $key == BetModel::STATUS_WAITING_DRAW
                    || $key == BetModel::STATUS_PLAYED
                    || $key == BetModel::STATUS_REFUND
                    || $key == BetModel::STATUS_WIN
                    || $key == BetModel::STATUS_AUTH_PENDING
                    || $key == BetModel::STATUS_PAYOUT_PENDING
                    || $key == BetModel::STATUS_PAYOUT
                    || $key == BetModel::STATUS_CLOSED
                )) {

                return false;
            }

            if ($bet->status == BetModel::STATUS_PAYOUT_PENDING && (
                    $key == BetModel::STATUS_PAID
                    || $key == BetModel::STATUS_WAITING_DRAW
                    || $key == BetModel::STATUS_PLAYED
                    || $key == BetModel::STATUS_REFUND
                    || $key == BetModel::STATUS_WIN
                    || $key == BetModel::STATUS_AUTH_PENDING
                    || $key == BetModel::STATUS_NOT_AUTH
                    || $key == BetModel::STATUS_CANCELLED
                )) {

                return false;
            }

            if ($bet->status == BetModel::STATUS_PAYOUT && $key != BetModel::STATUS_PAYOUT && $key != BetModel::STATUS_CLOSED ){

                return false;
            }

            return true;

        }, ARRAY_FILTER_USE_BOTH);

        return $statuses;
    }

    public function markAsWin( BetModel $bet )
    {
        $bet->status = BetModel::STATUS_WIN;
        $bet->save();
    }

    public function markAsPlayed( BetModel $bet )
    {
        $bet->status = BetModel::STATUS_PLAYED;
        $bet->save();
    }

    public function getByUser( UserModel $user )
    {
        $query = BetModel::query();

        return $query->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(25);

    }
}
