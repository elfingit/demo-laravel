<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Auth\LoginController@showLoginForm');

//TODO disable registration
Auth::routes();

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => 'role_acl'], function () {
	Route::get('/', [
		'uses'  => 'DashboardController@index',
		'as'    => 'index'
	]);

	Route::resource('brands', 'BrandController');
    Route::resource('bets', 'BetController');

	Route::get('/brands/{brand}/renew', [
		'uses'  => 'BrandController@renew',
		'as'    => 'brands.renew'
	]);

	Route::group(['prefix' => 'crm_api', 'as' => 'crm_api.'], function () {
		Route::resource('brands.brand_prices', 'BrandPriceController')
			->except(['create', 'show', 'edit']);

		Route::resource('brands.extra_games', 'BrandExtraGameController')
		     ->except(['create', 'show', 'edit']);

		Route::get('/users/{user}/available_balance', [
			'uses'  => 'UserAvailableBalanceController@index',
			'as'    => 'users.available_balance.index'
		]);

		Route::post('/users/{user}/available_balance', [
			'uses'  => 'UserAvailableBalanceController@store',
			'as'    => 'users.available_balance.store'
		]);

		Route::put('/bets/{bet}', [
		    'uses'  => 'BetController@update',
		    'as'  => 'bet.update',
        ]);

		Route::put('/users/{user}/status', [
		    'uses'  => 'UserController@changeStatus',
            'as'    => 'users.status.update'
        ]);

        Route::put('/users/{user}/param_toggle', [
            'uses'  => 'UserController@paramToggle',
            'as'    => 'users.authorized.param_toggle'
        ]);

        Route::get('/users/{user}/show_field', [
            'uses'  => 'UserController@showField',
            'as'    => 'users.show.field'
        ]);

        Route::get('/users/{user}/bets', [
            'uses'  => 'UserController@bets',
            'as'    => 'users.bets.index'
        ]);

        Route::get('/users/{user}/bets_pending', [
            'uses'  => 'UserController@betsPending',
            'as'    => 'users.bets.pending'
        ]);

        Route::get('/users/{user}/transactions', [
            'uses'  => 'UserController@transactions',
            'as'    => 'users.transactions.index'
        ]);

        Route::post('/auth_docs', [
            'uses'  => 'UserAuthDocController@store',
            'as'    => 'user.auth_docs'
        ]);

        Route::get('/auth_docs/{user}', [
            'uses'  => 'UserAuthDocController@index',
            'as'    => 'user.auth_docs.index'
        ]);

        Route::put('/user/{user}/doc/{doc}/status', [
            'uses'  => 'UserAuthDocController@update',
            'as'    => 'user.auth_docs.update'
        ]);

        Route::post('/lead_to_order/{lead}', [
            'uses'  => 'LeadController@toOrder',
            'as'    => 'lead.to_order'
        ]);
	});

	Route::get('/leads', [
		'uses'  => 'LeadController@index',
		'as'    => 'leads.index'
	]);

	Route::resource('users', 'UserController');

	Route::get('/user/{user}/doc/{doc}', [
	    'uses'  => 'UserAuthDocController@download',
        'as'    => 'user.auth_docs.download'
    ]);

	Route::get('/users/{user}/available_balance/show', [
		'uses'  => 'UserAvailableBalanceController@show',
		'as'    => 'users.available_balance.show'
	]);

	Route::resource('orders', 'OrderController')
                ->except(['create', 'store']);

	Route::get('/auth_docs', [
        'uses'  => 'UserAuthDocController@section',
        'as'    => 'auth_docs.index'
    ]);

    Route::get('/withdrawable', [
        'uses'  => 'WithdrawableController@index',
        'as'    => 'withdrawable.index'
    ]);

    Route::get('/payouts', [
        'uses'  => 'PayoutsController@index',
        'as'    => 'payouts.index'
    ]);

    Route::get('/payouts/{payout}', [
        'uses'  => 'PayoutsController@show',
        'as'    => 'payouts.show'
    ]);
});

