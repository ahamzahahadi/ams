<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('login', function() {
	return view('login');
});

Route::get('/addHardware', function() {
	return view('hardware.form');
});

Route::group(['middleware' => ['web']], function(){
	Route::resource('hardware', 'HardwareController');
	Route::resource('book', 'BookController');
	Route::resource('supplier', 'SupplierController');
	Route::resource('staff', 'StaffController');
});
