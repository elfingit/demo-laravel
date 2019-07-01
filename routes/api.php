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

		Route::post('password/email', 'Api\Auth\ForgotPasswordController@sendResetLinkEmail')
		     ->middleware('scopes:reset_password_link');

		Route::post('password/reset', 'Api\Auth\ForgotPasswordController@sendResetLinkEmail')
			->middleware('scopes:reset_password');

		Route::post('user', [
			'middleware'    => 'scopes:add_user',
			'uses'  => 'UserController@create',
			'as'    => 'user.register'
		]);
	});
});

Route::middleware('auth:api')->post('oauth/token/refresh', '\Laravel\Passport\Http\Controllers\TransientTokenController@refresh');

//\Laravel\Passport\Passport::routes();
