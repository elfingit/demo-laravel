<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthDocStoreRequest;
use App\Http\Resources\UserAuthDocResource;
use App\Model\User as UserModel;
use App\Model\UserAuthDoc as UserAuthDocModel;
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

    public function download(UserModel $user, UserAuthDocModel $doc)
    {
        $file = \UserAuthDoc::getFile($user, $doc);

        if ($file === false) {
            abort(404);
        }

        return response()->download($file);
    }

    public function section()
    {
        $docs = \UserAuthDoc::all();

        return view('auth_doc.index', compact('docs'));
    }
}
