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
	});

	Route::get('/leads', [
		'uses'  => 'LeadController@index',
		'as'    => 'leads.index'
	]);

	Route::resource('users', 'UserController');

	Route::get('/users/{user}/available_balance/show', [
		'uses'  => 'UserAvailableBalanceController@show',
		'as'    => 'users.available_balance.show'
	]);

	Route::resource('orders', 'OrderController')
                ->except(['create', 'store']);

});

