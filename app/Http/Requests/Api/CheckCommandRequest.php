<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-27
 * Time: 16:57
 */

namespace App\Http\Requests\Api;


use App\Http\Requests\AbstractRequest;

class CheckCommandRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'key'       => 'required|exists:remote_commands,key',
            'host'      => 'required|string'
        ];
    }
}
