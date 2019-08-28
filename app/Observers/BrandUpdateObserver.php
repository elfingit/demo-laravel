<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-28
 * Time: 07:16
 */

namespace App\Observers;


use App\Jobs\SetSystemCommandJob;
use App\Model\Brand as BrandModel;

class BrandUpdateObserver
{
    public function updated(BrandModel $brand)
    {
        SetSystemCommandJob::dispatch('clear_cache:brand:' . $brand->api_code);
    }
}
