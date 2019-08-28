<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-28
 * Time: 07:18
 */

namespace App\Observers;


use App\Jobs\SetSystemCommandJob;
use App\Model\BrandResult as BrandResultModel;

class BrandResultObserver
{
    public function created(BrandResultModel $result)
    {
        SetSystemCommandJob::dispatch('clear_cache:brand:' . $result->brand->api_code);
        SetSystemCommandJob::dispatch('clear_number_shield:brand:' . $result->brand->api_code);
    }

    public function updated(BrandResultModel $result)
    {
        SetSystemCommandJob::dispatch('clear_cache:brand:' . $result->brand->api_code);
    }
}
