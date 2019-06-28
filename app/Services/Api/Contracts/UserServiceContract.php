<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-28
 * Time: 16:56
 */

namespace App\Services\Api\Contracts;

use Illuminate\Foundation\Http\FormRequest;

interface UserServiceContract
{
	public function create(FormRequest $request);
}