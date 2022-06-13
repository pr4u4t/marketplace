<?php

Route::get('/', 'IndexController@home')->name('home');

Route::get('/category/{category}', 'IndexController@category')->name('market.category.show');

Route::get('/login', 'IndexController@login')->name('login');
Route::get('/confirmation', 'IndexController@confirmation')->name('confirmation');

Route::get('setview/{list}', 'IndexController@setView')->name('setview');

//User routes
Route::get('users','IndexController@showUsers')->name('users.show');
Route::get('user/{user}','IndexController@showUser')->name('user.show');

// Product routes
Route::get('product/{product}', 'ProductController@show')->name('product.show');
Route::get('product/{product}/rules', 'ProductController@showRules')->name('product.rules');
Route::get('product/{product}/feedback', 'ProductController@showFeedback')->name('product.feedback');
Route::get('product/{product}/delivery', 'ProductController@showDelivery')->name('product.delivery');
Route::get('product/{product}/vendor', 'ProductController@showVendor')->name('product.vendor');

// category routes
//Route::get('category/{category}', 'IndexController@category')->name('category.show');

// vendor routes
Route::get('vendor/{user}', 'IndexController@vendor')->name('vendor.show');

Route::get('vendor/{user}/feedback', 'IndexController@vendorsFeedbacks')->name('vendor.show.feedback');

Route::post('search','SearchController@search')->name('search');
Route::get('search','SearchController@searchShow')->name('search.show');

Route::get('contact','IndexController@contact')->name('contact');
Route::get('contact/post','IndexController@postMessage')->name('contact.post');

Route::get('shop','IndexController@shop')->name('index.shop');
Route::get('vendors','IndexController@vendors')->name('vendors');
Route::get('categories','IndexController@categories')->name('categories');
