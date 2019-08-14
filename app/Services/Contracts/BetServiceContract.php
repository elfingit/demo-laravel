<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-31
 * Time: 17:47
 */
namespace App\Services\Contracts;
use App\Model\Bet as BetModel;
use App\Model\User as UserModel;
use Illuminate\Http\Request;

interface BetServiceContract
{
    public function changeBetStatus(BetModel $bet, $status);

    public function list(Request $request);

    public function getStatuses(BetModel $bet = null);

    public function markAsWin(BetModel $bet);
    public function markAsPlayed(BetModel $bet);

    public function getByUser(UserModel $user);

    public function moveAuthPendingBetsToNotAuth();
}
