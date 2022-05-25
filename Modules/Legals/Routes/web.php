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

Route::prefix('legals')->group(function() {
	Route::get('/', 'LegalsController@index');
	Route::get('/terms','LegalsController@terms')->name('legals.terms');
	Route::get('/faq','LegalsController@faq')->name('legals.faq');
	Route::get('/mission','LegalsController@mission')->name('legals.mission');
});
