<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function(){
	return Redirect::to('/signup');
});

/**
 * ========================================================================
 * LOGIN & SIGNUP PAGES & PROCESS
 * Confide Routes
 */
Route::get('/signup', 'UsersController@createSignUp');
Route::post('/signup', 'UsersController@doSignUp');
Route::get('/login', 'UsersController@createLogin');
Route::post('/login', 'UsersController@doLogin');
Route::get('/confirm/{code}', 'UsersController@confirm');
Route::get('/forgot_pass', 'UsersController@forgotPassword');
Route::post('/forgot_pass', 'UsersController@doForgotPassword');
Route::get('/reset_pass/{token}', 'UsersController@resetPassword');
Route::post('/reset_pass', 'UsersController@doResetPassword');
Route::get('/logout', 'UsersController@logout');



/**
 * DASHBOARD HOME PAGE
 */
Route::get('/user/dashboard', function(){
	return View::make('home.dashboard');
});

Route::get('user/', function(){
	return Redirect::to('user/dashboard');
});

Route::when('user/*', 'auth');

/*Route::get('/login', function(){
	if('auth'){
		return Redirect::to('user/dashboard');
	}
});*/


/**
 * ======================================================================
 * ROUTES TO URLS BEYOND '/user/*'
 */
Route::get('user/orders', 'DashboardController@showOrders');
Route::post('user/edit_item', 'DashboardController@updateItem');
Route::get('user/edit_item/{id}', 'DashboardController@editItem');
Route::get('user/edit_item/delete/{id}', 'DashboardController@deleteItem');
Route::get('user/products/{id}', 'DashboardController@showProducts');

Route::get('user/orders/process', 'DashboardController@makePayment');
Route::post('home/payment/complete','DashboardController@completeTransaction');


Route::get('user/invoices', 'DashboardController@showInvoices');
Route::get('user/statements', 'DashboardController@showStatements');

Route::get('user/new-order', 'DashboardController@showNewOrder');
Route::post('user/new-order', 'DashboardController@setOrder');

Route::post('user/new-order/commit', 'DashboardController@saveOrder');



/**
 * ROUTES FOR CREATING A NEW ORDER
 */
