<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-09
 * Time: 11:16
 */
namespace App\Services\Contracts;

use App\Model\User as UserModel;
use Illuminate\Foundation\Http\FormRequest;

interface UserAuthDocServiceContract
{
    public function store(FormRequest $request);
    public function list(UserModel $user);
    public function rejectDoc(UserModel $user, FormRequest $request);
    public function approveDoc(UserModel $user, FormRequest $request);
}
