<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-09
 * Time: 11:17
 */
namespace App\Services;

use App\Model\User as UserModel;
use App\Model\UserAuthDoc as UserAuthDocModel;
use App\Model\Bet as BetModel;
use App\Services\Contracts\UserAuthDocServiceContract;
use Illuminate\Foundation\Http\FormRequest;

class UserAuthDocService implements UserAuthDocServiceContract
{
    public function store( FormRequest $request )
    {
        $user_id = $request->get('user_id');
        $path = $this->getStoragePath($user_id);

        $file_name = $this->uploadDoc($path, $request);

        $data = $request->only(['type', 'comments', 'valid_till']);
        $data['user_id'] = $user_id;
        $data['file_name'] = $file_name;

        if ($request->has('bet_id')) {
            $data['bet_id'] = $request->get('bet_id');
        }

        return UserAuthDocModel::create($data);

    }

    public function list( UserModel $user )
    {
        return $user->docs;
    }

    public function rejectDoc( UserModel $user, FormRequest $request )
    {
        if ($request->has('entityId')) {
            $docId = $request->get('entityId');

            $doc = $user->docs()
                    ->where('user_auth_docs.id', $docId)
                    ->first();

            if ($doc) {
                $value = $request->get('value');

                if ($value == true) {
                    $doc->is_approved = false;
                    $doc->is_rejected = true;
                } else {
                    $doc->is_rejected = false;
                }

                $doc->save();
            }
        }
    }

    public function approveDoc( UserModel $user, FormRequest $request )
    {
        if ($request->has('entityId')) {
            $docId = $request->get('entityId');

            $doc = $user->docs()
                        ->where('user_auth_docs.id', $docId)
                        ->first();

            if ($doc) {
                $value = $request->get('value');

                if ($value == true) {
                    $doc->is_approved = true;
                    $doc->is_rejected = false;

                    if ($doc->bet) {
                        \Bet::changeBetStatus($doc->bet, BetModel::STATUS_PAYOUT_PENDING);
                    }

                } else {
                    $doc->is_approved = false;
                }

                $doc->save();
            }
        }
    }

    public function getFile( UserModel $user, UserAuthDocModel $doc )
    {
        $path = $this->getStoragePath($user->id);

        $file = $path . '/' .$doc->file_name;

        if (!file_exists($file)) {
            return false;
        }

        $doc->download_count = $doc->download_count + 1;
        $doc->save();


        return $file;
    }

    public function all()
    {
        $query = UserAuthDocModel::query();

        $query->orderBy('created_at', 'desc');

        return $query->paginate(25);
    }

    protected function getStoragePath($user_id)
    {
        return storage_path('docs/' . $user_id);
    }

    protected function uploadDoc($path, $request)
    {
        if (!file_exists($path)) {
            mkdir($path, 0775, true);
        }

        $doc = str_replace('.', '_', microtime(true)) .'-doc.'.$request->doc->getClientOriginalExtension();

        $request->doc->move($path, $doc);

        return $doc;
    }
}
