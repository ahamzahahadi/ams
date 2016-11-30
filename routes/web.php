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

Route::get('/getval', function(){
	return view('getval');
});

Route::get('/testbtn', function(){
	return view('testbtn');
});

Route::get('/addHardware', function() {
	return view('hardware.form');
});

Route::get('/record/form/{id}',['uses' => 'RecordController@recform']);
Route::get('/record/returnform/{id}',['uses' => 'RecordController@returnasset']);
Route::post('record/returned', ['uses' => 'RecordController@returnedit']);

Route::group(['middleware' => 'auth'], function(){
	Route::resource('hardware', 'HardwareController');
	Route::resource('supplier', 'SupplierController');
	Route::resource('staff', 'StaffController');
	Route::resource('software', 'SoftwareController');
	Route::resource('record', 'RecordController');
});
