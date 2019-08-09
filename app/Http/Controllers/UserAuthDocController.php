<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthDocStoreRequest;
use Illuminate\Http\Request;

class UserAuthDocController extends Controller
{
    public function store(UserAuthDocStoreRequest $request)
    {
        $doc = \UserAuthDoc::store($request);
    }
}
