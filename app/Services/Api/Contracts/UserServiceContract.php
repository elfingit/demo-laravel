<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-28
 * Time: 16:56
 */

namespace App\Services\Api\Contracts;

use App\Model\User as UserModel;
use Illuminate\Foundation\Http\FormRequest;

interface UserServiceContract
{
	public function create(FormRequest $request);
}
