<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-12
 * Time: 12:47
 */

namespace App\Services\Api\Contracts;

use Illuminate\Foundation\Http\FormRequest;

interface UserAuthDocServiceContract
{
    public function addDoc(FormRequest $request);
}
