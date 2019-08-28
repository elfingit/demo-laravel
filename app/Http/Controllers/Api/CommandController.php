<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-27
 * Time: 15:26
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CheckCommandRequest;

class CommandController extends Controller
{
    public function check(CheckCommandRequest $request)
    {
        $result = \ApiCommand::check($request->get('host'), $request->get('key'));

        if ($result !== true) {
            logger()->error('Check command fail. Host: ' . $result->get('host'));
        }

        return response()->json([
            'success'   => $result
        ]);
    }
}
