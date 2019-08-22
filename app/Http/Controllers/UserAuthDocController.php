<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthDocStatusRequest;
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

    public function update(UserAuthDocStatusRequest $request, UserModel $user, UserAuthDocModel $doc)
    {
        $last_approved = false;

        if ($request->get('status') === "0") {
            \UserAuthDoc::rejectDoc($user, $doc);
        } elseif ($request->get('status') === "1") {
            \UserAuthDoc::approveDoc($user, $doc);
            $last_approved = \UserAuthDoc::isLastApproved($user);
        }

        return response()->json([
            'status'            => 'success',
            'last_approved'     => $last_approved
        ]);
    }
}
