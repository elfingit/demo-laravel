<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-15
 * Time: 09:58
 */

namespace App\Services;

use App\Lib\Query\Criteria;
use App\Services\Contracts\UserServiceContract;

class UserService implements UserServiceContract
{
	public function list( Criteria $criteria )
	{
		return $criteria->paginate();
	}
}