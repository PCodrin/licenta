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

Route::get('/', 'HomeController@index');

Route::resource('/products', 'ProductsController', ['except' => ['create', 'show','edit']]);

Route::get('/forgotPassword', 'ForgotPasswordController@index');
Route::post('/forgotPassword', 'ForgotPasswordController@sendResetLinkEmail');
Route::get('/resetPassword/{token}', 'ForgotPasswordController@showForm');
Route::put('/resetPassword', 'ForgotPasswordController@resetPassword');
Route::get('/register', 'UsersController@index');
Route::post('/register', 'UsersController@store');

Route::get('/profile', 'UsersController@show')->middleware('auth');
Route::put('/profile', 'UsersController@update')->middleware('auth');
Route::put('/profileUpdateUserPassword', 'UsersController@updateUserPassword')->middleware('auth');
Route::put('/profileUpdateUserMoney', 'UsersController@updateUserMoney')->middleware('auth');

Route::get('/login', 'LoginUsersController@index')->name('login');
Route::post('/login', 'LoginUsersController@login');

Route::get('/logout', 'LoginUsersController@logout');

Route::get('/shoppingCart', 'ShoppingCartsController@index');
Route::post('/addToCart/{product}', 'ShoppingCartItemsController@addToCart');

Route::post('/shoppingCartItemsUpdate/{shoppingCartItem}', 'ShoppingCartItemsController@update')->name('update');
Route::delete('/shoppingCartItemsDelete/{shoppingCartItem}', 'ShoppingCartItemsController@destroy')->name('delete');


Route::resource('/orders', 'OrdersController', ['only' => ['index', 'show','store']]);

/* Test commit*/

