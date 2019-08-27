<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-27
 * Time: 17:12
 */

namespace App\Services\Contracts;


interface RemoteSystemCommandContract
{
    public function add($name, $host);
}
