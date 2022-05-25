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


Route::name('auth.')->group(function () {
    include 'auth.php';
});

Route::prefix('admin')->group(function (){
    Route::middleware(['admin_panel_access'])->group(function () {
        include 'admin.php';
    });
});

// Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('banned', 'ProfileController@banned')->name('profile.banned');
    Route::middleware(['is_banned'])->group(function(){
        include 'profile.php';
    });

    if(!Config::get('app.public')){
	include 'public.php';
    }
});

if(Config::get('app.public')){
	include 'public.php';
}
