<?php

namespace App\Providers;

use App\Services\BrandCheckDateService;
use App\Services\BrandDrawService;
use App\Services\BrandJackpotService;
use App\Services\BrandPriceService;
use App\Services\BrandResultService;
use App\Services\BrandService;
use App\Services\Contracts\BrandCheckDateContract;
use App\Services\Contracts\BrandDrawServiceContract;
use App\Services\Contracts\BrandJackpotServiceContract;
use App\Services\Contracts\BrandPriceServiceContract;
use App\Services\Contracts\BrandResultContract;
use App\Services\Contracts\BrandServiceContract;
use App\Services\Contracts\LeadServiceContract;
use App\Services\Contracts\UserServiceContract;
use App\Services\LeadService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
	    if ($this->app->environment() !== 'production') {
		    $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
	    }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    	//Blade extensions
	    \Blade::directive('brand_status', function ($status) {
	    	return '<?php echo \App\Lib\ViewHelpers::brandStatusHuman('.$status.') ?>';
	    });

		//Contracts mapping
    	$this->app->bind(BrandServiceContract::class, BrandService::class);
    	$this->app->bind(BrandPriceServiceContract::class, BrandPriceService::class);
		$this->app->bind(BrandResultContract::class, BrandResultService::class);
    	$this->app->bind(BrandCheckDateContract::class, BrandCheckDateService::class);
    	$this->app->bind(LeadServiceContract::class, LeadService::class);
    	$this->app->bind(UserServiceContract::class, UserService::class);
    }
}
