<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-17
 * Time: 10:36
 */

namespace App\Services\Contracts;

use App\Model\User as UserModel;
use Illuminate\Http\Request;

interface UserAvailableBalanceServiceContract
{
	public function list(Request $request, UserModel $user);
}