<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-15
 * Time: 09:58
 */

namespace App\Services\Contracts;

use App\Lib\Query\Criteria;

interface UserServiceContract
{
	public function list(Criteria $criteria);
}