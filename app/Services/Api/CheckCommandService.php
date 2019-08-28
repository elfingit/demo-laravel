<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-28
 * Time: 07:33
 */

namespace App\Services\Api;

use App\Model\RemoteCommand as RemoteCommandModel;
use App\Services\Api\Contracts\CheckCommandServiceContract;

class CheckCommandService implements CheckCommandServiceContract
{
    public function check( $host, $key )
    {
        $command = RemoteCommandModel::query()
            ->where('host', $host)
            ->where('key', $key)
            ->first();

        if ($command) {
            $command->delete();

            return true;
        }

        return false;
    }
}
