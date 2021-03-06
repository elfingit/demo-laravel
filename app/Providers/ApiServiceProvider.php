<?php

namespace App\Providers;

use App\Facades\Api\LoggerFacade;
use App\Services\Api\BetService;
use App\Services\Api\BrandService;
use App\Services\Api\CheckCommandService;
use App\Services\Api\Contracts\BetServiceContract;
use App\Services\Api\Contracts\BrandServiceContract;
use App\Services\Api\Contracts\CheckCommandServiceContract;
use App\Services\Api\Contracts\LeadServiceContract;
use App\Services\Api\Contracts\OrderServiceContract;
use App\Services\Api\Contracts\PayoutServiceContract;
use App\Services\Api\Contracts\UserAuthDocServiceContract;
use App\Services\Api\Contracts\UserServiceContract;
use App\Services\Api\Contracts\WithdrawableServiceContract;
use App\Services\Api\LeadService;
use App\Services\Api\OrderService;
use App\Services\Api\PayoutService;
use App\Services\Api\UserAuthDocService;
use App\Services\Api\UserService;
use App\Services\Api\WithdrawableService;
use Illuminate\Support\ServiceProvider;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

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
	    //Logger
        $this->app->bind(LoggerFacade::BIND_KEY, function () {
            $apiLog = new Logger('api');

            $apiLog->pushHandler(new RotatingFileHandler(storage_path('logs/api.log')));

            return $apiLog;
        });

        //Contracts mapping
	    $this->app->bind(UserServiceContract::class, UserService::class);
    }
}
