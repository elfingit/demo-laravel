<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthDocStoreRequest;
use App\Http\Resources\UserAuthDocResource;
use App\Model\User as UserModel;
use Illuminate\Http\Request;

class UserAuthDocController extends Controller
{
    public function store(UserAuthDocStoreRequest $request)
    {
        $doc = \UserAuthDoc::store($request);

        return new UserAuthDocResource($doc);
    }

    public function index(UserModel $user)
    {
        $docs = \UserAuthDoc::list($user);

        return UserAuthDocResource::collection($docs);
    }
}
