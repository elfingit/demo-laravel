<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-09
 * Time: 11:34
 */

namespace App\Services\Contracts;

use App\Model\User as UserModel;
use Illuminate\Http\Request;

interface LeadServiceContract
{
	public function list(Request $request);
	public function getListByUser(UserModel $user);
}
