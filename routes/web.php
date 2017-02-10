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
Route::get('/error', function(){
	return view('dberror');
});

Route::get('login', function() {
	return view('login');
});

Route::get('/getval', function(){
	return view('getval');
});

Route::get('/testbtn', function(){
	return view('testbtn');
});

Route::get('/swcategories', function() {
	return view('software.category');
});
Route::get('/hwcategories', function() {
	return view('hardware.category');
});

Route::get('/bycategory/{cat}',['uses' => 'HardwareController@cat']);
Route::get('/bySoftwareCategory/{cat}',['uses' => 'SoftwareController@cat']);

Route::get('/record/form/{id}',['uses' => 'RecordController@recform']);
Route::get('/record/returnform/{id}',['uses' => 'RecordController@returnasset']);
Route::get('/record/berform/{id}',['uses' => 'RecordController@berform']);
Route::get('/record/faultyform/{id}',['uses' => 'RecordController@faultyform']);
Route::get('/record/stolenform/{id}',['uses' => 'RecordController@stolenform']);
Route::get('/record/mafform/{id}',['uses' => 'RecordController@mafform']);
Route::get('/record/missingform/{id}',['uses' => 'RecordController@missingform']);
Route::get('/record/repairform/{id}',['uses' => 'RecordController@repairform']);

Route::post('record/changestatus',['uses' => 'RecordController@changestatus']);
Route::post('record/returned', ['uses' => 'RecordController@returnedit']);
Route::post('hwrecord/modalassign', ['uses' => 'RecordController@modalassign']);

Route::get('/swrecord/installform/{id}',['uses' => 'SwRecordController@installform']);
Route::get('/swrecord/uninstallform/{id}',['uses' => 'SwRecordController@uninstallform']);
Route::post('swrecord/modalinstall', ['uses' => 'SwRecordController@modalinstall']);
Route::post('swrecord/uninstalled', ['uses' => 'SwRecordController@uninstall']);
Route::get('/swrecord/uninstalllist/{id}', ['uses' => 'SwRecordController@uninstalllist']);

Route::post('category', ['uses' => 'CategoryController@store']);
Route::post('loan', ['uses' => 'LoanController@store']);
Route::delete('/loan/{loan}', ['uses' => 'LoanController@padam', 'as' => 'loan.padam']);
Route::delete('/stafftmp/{id}', ['uses' => 'WidgetController@padamstafftmp', 'as' => 'stafftmp.padam']);

Route::get('/ageReport', 'ExcelController@hwAgeReport');
Route::get('/downloadExcel', 'ExcelController@downloadExcel');

Route::group(['middleware' => 'auth'], function(){
	Route::resource('hardware', 'HardwareController');
	Route::resource('supplier', 'SupplierController');
	Route::resource('staff', 'StaffController');
	Route::resource('software', 'SoftwareController');
	Route::resource('record', 'RecordController');
	Route::resource('swrecord', 'SwRecordController');
});
