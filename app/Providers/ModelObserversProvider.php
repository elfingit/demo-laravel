<?php

namespace App\Providers;

use App\Model\Bet as BetModel;
use App\Observers\BetStatusObserver;
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
    }
}
