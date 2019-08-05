<?php

namespace App\Providers;

use App\Lib\Calculators\EuroMillionsCalculator;
use App\Lib\Calculators\PowerBallCalculator;
use App\Services\BetService;
use App\Services\BrandCheckDateService;
use App\Services\BrandDrawService;
use App\Services\BrandExtraGameService;
use App\Services\BrandJackpotService;
use App\Services\BrandPriceService;
use App\Services\BrandResultService;
use App\Services\BrandService;
use App\Services\Contracts\BetServiceContract;
use App\Services\Contracts\BrandCheckDateContract;
use App\Services\Contracts\BrandDrawServiceContract;
use App\Services\Contracts\BrandExtraGameServiceContract;
use App\Services\Contracts\BrandJackpotServiceContract;
use App\Services\Contracts\BrandPriceServiceContract;
use App\Services\Contracts\BrandResultContract;
use App\Services\Contracts\BrandServiceContract;
use App\Services\Contracts\LeadServiceContract;
use App\Services\Contracts\OrderServiceContract;
use App\Services\Contracts\TicketServiceContract;
use App\Services\Contracts\UserAvailableBalanceServiceContract;
use App\Services\Contracts\UserRoleServiceContract;
use App\Services\Contracts\UserServiceContract;
use App\Services\Contracts\WinningsServiceContract;
use App\Services\LeadService;
use App\Services\OrderService;
use App\Services\TicketService;
use App\Services\UserAvailableBalanceService;
use App\Services\UserRoleService;
use App\Services\UserService;
use App\Services\WinningsService;
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
    	//Brand
	    $this->app->bind(BrandServiceContract::class, BrandService::class);
    	$this->app->bind(BrandPriceServiceContract::class, BrandPriceService::class);
		$this->app->bind(BrandResultContract::class, BrandResultService::class);
    	$this->app->bind(BrandCheckDateContract::class, BrandCheckDateService::class);
    	$this->app->bind(BrandExtraGameServiceContract::class, BrandExtraGameService::class);
    	//Lead
    	$this->app->bind(LeadServiceContract::class, LeadService::class);
    	//User
    	$this->app->bind(UserServiceContract::class, UserService::class);
    	$this->app->bind(UserRoleServiceContract::class, UserRoleService::class);
    	$this->app->bind(UserAvailableBalanceServiceContract::class, UserAvailableBalanceService::class);

    	//Order
        $this->app->bind(OrderServiceContract::class, OrderService::class);

        //Bet
        $this->app->bind(BetServiceContract::class, BetService::class);

        //Bet ticket
        $this->app->bind(TicketServiceContract::class, TicketService::class);

        //Winnings
        $this->app->bind(WinningsServiceContract::class, WinningsService::class);

        //Win calculators
        $this->app->bind(WinningsService::CALCULATOR_PREFIX.'us_powerball', PowerBallCalculator::class);
        $this->app->bind(WinningsService::CALCULATOR_PREFIX.'euromillions', EuroMillionsCalculator::class);
    }
}
