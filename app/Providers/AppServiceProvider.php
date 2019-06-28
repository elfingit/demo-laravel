<?php

namespace App\Providers;

use App\Services\BrandDrawService;
use App\Services\BrandPriceService;
use App\Services\BrandService;
use App\Services\Contracts\BrandDrawServiceContract;
use App\Services\Contracts\BrandPriceServiceContract;
use App\Services\Contracts\BrandServiceContract;
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
    	$this->app->bind(BrandDrawServiceContract::class, BrandDrawService::class);
    }
}
