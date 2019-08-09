<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-09
 * Time: 11:16
 */
namespace App\Services\Contracts;

use Illuminate\Foundation\Http\FormRequest;

interface UserAuthDocServiceContract
{
    public function store(FormRequest $request);
}
