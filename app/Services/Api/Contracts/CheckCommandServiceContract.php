<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-28
 * Time: 07:32
 */

namespace App\Services\Api\Contracts;


interface CheckCommandServiceContract
{
    public function check($host, $key);
}
