<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-29
 * Time: 16:35
 */
namespace App\Services\Api\Contracts;

use App\Model\User as UserModel;
use Illuminate\Foundation\Http\FormRequest;

interface OrderServiceContract
{
    public function create(FormRequest $request, UserModel $user);
}
