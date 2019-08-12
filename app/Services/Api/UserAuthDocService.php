<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-12
 * Time: 12:47
 */

namespace App\Services\Api;


use App\Model\UserAuthDoc as UserAuthDocModel;
use App\Services\Api\Contracts\UserAuthDocServiceContract;
use Illuminate\Foundation\Http\FormRequest;

class UserAuthDocService implements UserAuthDocServiceContract
{
    public function addDoc( FormRequest $request )
    {
        $user_id = \Auth::user()->id;
        $path = $this->getStoragePath($user_id);

        $file_name = $this->uploadDoc($path, $request);

        $data = [
            'comment' => 'Upload through API',
            'type'    => 'Passport/ID'
        ];
        $data['user_id'] = $user_id;
        $data['file_name'] = $file_name;

        return UserAuthDocModel::create($data);
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
