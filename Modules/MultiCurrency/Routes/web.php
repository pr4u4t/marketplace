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

Route::prefix('multicurrency')->group(function() {
	Route::post('user/{id}/change','MultiCurrencyController@update')->name('profile.currency.change');
	Route::get('change/{currency}','MultiCurrencyController@change')->name('session.currency.change');
});
