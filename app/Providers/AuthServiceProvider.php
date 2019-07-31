<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::loadKeysFrom(storage_path());

        Passport::tokensCan([
        	'add_user'  => 'Adding users (registration)',
	        'auth_user' => 'Authenticate user',
	        'reset_password_link' => 'Forgot password',
	        'reset_password'    => 'Set new password for user',
	        'brands_list'       => 'Get list of brands',
	        'brand_show'        => 'Get data of brand',
	        'brand_results'     => 'Get brand results',
	        'lead_create'       => 'Create lead',
	        'lead_update'       => 'Update lead',
            'create_order'      => 'Create order',
            'get_user_balance'  => 'Get user balance'
        ]);
    }
}
