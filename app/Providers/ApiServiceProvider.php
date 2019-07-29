<?php

namespace App\Providers;

use App\Services\Api\BrandService;
use App\Services\Api\Contracts\BrandServiceContract;
use App\Services\Api\Contracts\LeadServiceContract;
use App\Services\Api\Contracts\OrderServiceContract;
use App\Services\Api\Contracts\UserServiceContract;
use App\Services\Api\LeadService;
use App\Services\Api\OrderService;
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
	    $this->app->bind(BrandServiceContract::class, BrandService::class);
	    $this->app->bind(LeadServiceContract::class, LeadService::class);
	    $this->app->bind(OrderServiceContract::class, OrderService::class);
    }
}
