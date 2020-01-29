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

Route::namespace('Api')->group(function () {

	Route::group(['prefix' => 'v1', 'as' => 'api.'], function () {

        Route::post( 'password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail' )
             ->middleware( 'client:reset_password_link' );

        Route::post( 'password/reset', 'Auth\ForgotPasswordController@reset' )
             ->middleware( 'client:reset_password' );

        Route::post( 'user', [
            'middleware' => 'client:add_user',
            'uses'       => 'UserController@create',
            'as'         => 'user.register'
        ] );

    });
});

