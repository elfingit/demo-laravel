<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-09
 * Time: 11:17
 */
namespace App\Services;

use App\Services\Contracts\UserAuthDocServiceContract;
use Illuminate\Foundation\Http\FormRequest;

class UserAuthDocService implements UserAuthDocServiceContract
{
    public function store( FormRequest $request )
    {
        // TODO: Implement store() method.
    }
}
