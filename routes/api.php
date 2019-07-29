<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');

Route::namespace('Api')->group(function () {

	Route::group(['prefix' => 'v1', 'as' => 'api.'], function () {

		Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
		     ->middleware('client:reset_password_link');

		Route::post('password/reset', 'Auth\ForgotPasswordController@reset')
			->middleware('client:reset_password');

		Route::post('user', [
			'middleware'    => 'client:add_user',
			'uses'  => 'UserController@create',
			'as'    => 'user.register'
		]);

		Route::get('brands', [
			'middleware'    => 'client:brands_list',
			'uses'  => 'BrandController@index',
			'as'    => 'brands.index'
		]);

		Route::get('brands/{brand}/results', [
			'middleware'    => 'client:brand_results',
			'uses'  => 'BrandController@results',
			'as'    => 'brands.results'
		]);

		Route::get('brands/{brand}', [
			'middleware'    => 'client:brand_show',
			'uses'  => 'BrandController@show',
			'as'    => 'brands.show'
		]);

		Route::post('leads', [
			'middleware'    => 'client:lead_create',
			'uses'  => 'LeadController@create',
			'as'    => 'leads.create'
		]);

		Route::put('leads/{lead}', [
			'middleware'    => 'client:lead_update',
			'uses'  => 'LeadController@update',
			'as'    => 'leads.update'
		]);

		Route::post('orders', [
            'middleware'    => ['auth:api', 'client:create_order'],
            'uses'  => 'OrderController@store',
            'as'    => 'orders.create'
        ]);
	});
});

Route::middleware('auth:api')->post('oauth/token/refresh', '\Laravel\Passport\Http\Controllers\TransientTokenController@refresh');

//\Laravel\Passport\Passport::routes();
