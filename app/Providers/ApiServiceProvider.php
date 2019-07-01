<?php

namespace App\Providers;

use App\Services\Api\Contracts\UserServiceContract;
use App\Services\Api\UserService;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
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
	    //Contracts mapping

	    $this->app->bind(UserServiceContract::class, UserService::class);
    }
}
