<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-31
 * Time: 17:48
 */
namespace App\Services;

use App\Lib\Query\Criteria;
use App\Model\Bet as BetModel;
use App\Services\Contracts\BetServiceContract;
use Illuminate\Http\Request;

class BetService implements BetServiceContract
{
    public function changeBetStatus(BetModel $bet, $status )
    {
        $bet->status = $status;
        $bet->save();

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

    public function getStatuses()
    {
        return [
            BetModel::STATUS_PAID => 'Paid',
            BetModel::STATUS_WAITING_DRAW => 'Waiting draw',
            BetModel::STATUS_PLAYED => 'Played',
            BetModel::STATUS_WIN => 'Win',
            BetModel::STATUS_REFUND => 'Refund',
            BetModel::STATUS_AUTH_PENDING => 'Authorization pending',
            BetModel::STATUS_NOT_AUTH => 'Not authorized',
            BetModel::STATUS_PAYOUT_PENDING => 'Payout pending',
            BetModel::STATUS_PAYOUT => 'Payout',
            BetModel::STATUS_CLOSED => 'Closed'
        ];
    }
}
