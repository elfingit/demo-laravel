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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => 'role_acl'], function () {
	Route::get('/', [
		'uses'  => 'DashboardController@index',
		'as'    => 'index'
	]);

	Route::resource('brands', 'BrandController');

	Route::group(['prefix' => 'crm_api', 'as' => 'crm_api.'], function () {
		Route::resource('brands.brand_prices', 'BrandPriceController');
	});
});

Route::get('/home', 'HomeController@index')->name('home');
