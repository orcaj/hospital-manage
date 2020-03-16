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

	Route::group(['middleware' => ['super']], function(){

	});

});


