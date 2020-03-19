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
    return view('auth.login');
});

Auth::routes();

//Auth
Route::group(['middleware' => ['web','auth']], function(){

	Route::get('/home', 'HomeController@index')->name('home');

	Route::resource('invoice', 'InvoiceController');
	Route::resource('patients', 'PatientController');
	Route::resource('staff', 'StaffController');
	Route::resource('department', 'DepartmentController');
	Route::resource('doctors', 'DoctorController');
	Route::resource('services', 'ServiceController');

	Route::get('status-change/{part}/{service_id}/{status}', 'HomeController@status_change')->name('status-change');	

	Route::post('get_patdata', 'InvoiceController@get_pat_date')->name('get_patdata');

	Route::post('get_service_data', 'InvoiceController@get_service_data')->name('get_service_data');

	Route::post('pat/multi_delete', 'PatientController@multi_delete')->name('pat.multi_delete');

	Route::post('pat/multi_status', 'PatientController@multi_status')->name('pat.multi_status');
	
	Route::group(['middleware' => ['super']], function(){

	});

});


