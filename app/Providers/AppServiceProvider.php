<?php

namespace App\Providers;

use App\Lib\Calculators\DeLottoCalculator;
use App\Lib\Calculators\EuroJackpotCalculator;
use App\Lib\Calculators\EuroMillionsCalculator;
use App\Lib\Calculators\MegaMillionsCalculator;
use App\Lib\Calculators\PowerBallCalculator;
use App\Lib\Calculators\UKNationalLotteryCalculator;
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
use App\Services\Contracts\PayoutServiceContract;
use App\Services\Contracts\RemoteSystemCommandContract;
use App\Services\Contracts\TicketServiceContract;
use App\Services\Contracts\UserAuthDocServiceContract;
use App\Services\Contracts\UserAvailableBalanceServiceContract;
use App\Services\Contracts\UserRoleServiceContract;
use App\Services\Contracts\UserServiceContract;
use App\Services\Contracts\UserWithdrawableBalanceServiceContract;
use App\Services\Contracts\WinningsServiceContract;
use App\Services\LeadService;
use App\Services\OrderService;
use App\Services\PayoutService;
use App\Services\RemoteSystemCommandService;
use App\Services\TicketService;
use App\Services\UserAuthDocService;
use App\Services\UserAvailableBalanceService;
use App\Services\UserRoleService;
use App\Services\UserService;
use App\Services\UserWithdrawableBalanceService;
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

    }
}
