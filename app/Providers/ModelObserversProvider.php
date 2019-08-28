<?php

namespace App\Providers;

use App\Model\Bet as BetModel;
use App\Model\Brand as BrandModel;
use App\Model\BrandResult as BrandResultModel;
use App\Observers\BetStatusObserver;
use App\Observers\BrandResultObserver;
use App\Observers\BrandUpdateObserver;
use Illuminate\Support\ServiceProvider;

class ModelObserversProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        BetModel::observe(BetStatusObserver::class);
        BrandModel::observe(BrandUpdateObserver::class);
        BrandResultModel::observe(BrandResultObserver::class);
    }
}
