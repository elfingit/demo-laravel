<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserAuthDocCreateRequest;
use App\Http\Controllers\Controller;

class UserAuthDocController extends Controller
{
    public function store(UserAuthDocCreateRequest $request)
    {
        \ApiUserAuthDoc::addDoc($request);

        return response()->json([], 204);
    }
}
