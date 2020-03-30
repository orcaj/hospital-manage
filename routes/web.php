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

	Route::post('status-change', 'HomeController@status_change')->name('status-change');
	Route::post('get_patdata', 'InvoiceController@get_pat_date')->name('get_patdata');
	Route::post('get_service_data', 'InvoiceController@get_service_data')->name('get_service_data');
	Route::post('pat/multi_delete', 'PatientController@multi_delete')->name('pat.multi_delete');
    Route::post('pat/multi_status', 'PatientController@multi_status')->name('pat.multi_status');
    Route::post('pat/get_patient_detail', 'PatientController@get_patient_detail')->name('pat.get_patient_detail');
    Route::post('pat/add_patient_on_invoice', 'PatientController@add_patient_on_invoice')->name('pat.add_patient_on_invoice');

	Route::post('pat/confirm_create', 'PatientController@confirm_create')->name('pat.confirm_create');
	Route::post('staf/confirm_create', 'StaffController@confirm_create')->name('staf.confirm_create');
	Route::post('staf/multi_delete', 'StaffController@multi_delete')->name('staf.multi_delete');
	Route::post('staf/multi_status', 'StaffController@multi_status')->name('staf.multi_status');
	Route::put('changePassword/{staff}', 'StaffController@changePassword')->name('staf.changePassword');
	Route::post('depart/check_duplication', 'DepartmentController@check_duplication')->name('depart.check_duplication');
	Route::post('depart/multi_delete', 'DepartmentController@multi_delete')->name('depart.multi_delete');
	Route::post('depart/multi_status', 'DepartmentController@multi_status')->name('depart.multi_status');

	Route::post('doct/check_duplication', 'DoctorController@check_duplication')->name('doct.check_duplication');
	Route::post('doct/multi_delete', 'DoctorController@multi_delete')->name('doct.multi_delete');
    Route::post('doct/multi_status', 'DoctorController@multi_status')->name('doct.multi_status');
    Route::post('doct/get_doctor_by_department', 'DoctorController@get_doctor_by_department')->name('doct.get_doctor_by_department');

    Route::post('servi/multi_delete', 'ServiceController@multi_delete')->name('servi.multi_delete');
    Route::post('servi/multi_status', 'ServiceController@multi_status')->name('servi.multi_status');
    Route::post('servi/get_service_by_doctor_depart', 'ServiceController@get_service_by_doctor_depart')->name('servi.get_service_by_doctor_depart');
    Route::post('servi/get_service_detail_on_invoice', 'ServiceController@get_service_detail_on_invoice')->name('servi.get_service_detail_on_invoice');

    // Route::get('add-invoice', 'InvoiceController@view_add_invoice')->name('invoice.view_add_invoice');
    Route::get('invoi/view_invoice/{id}', 'InvoiceController@view_invoice')->name('invoice.view_invoice');
    Route::post('invoi/add_invoice', 'InvoiceController@add_invoice')->name('invoi.add_invoice');
    Route::post('invoi/multi_delete', 'InvoiceController@multi_delete')->name('invoi.multi_delete');
    Route::post('invoi/multi_status', 'InvoiceController@multi_status')->name('invoi.multi_status');
    Route::post('invoi/send_invoice', 'InvoiceController@send_invoice')->name('invoi.send_invoice');
    Route::post('invoi/view_invoice/{id}', 'InvoiceController@view_invoice')->name('invoi.view_invoice');
    Route::get('invoi/download_invoice/{type}', 'InvoiceController@download_invoice')->name('invoi.download_invoice');
    Route::get('invoi/download_pdf', 'InvoiceController@download_pdf')->name('invoi.download_pdf');
    Route::post('invoi/get_invoice_history', 'InvoiceController@get_invoice_history')->name('invoi.get_invoice_history');
    Route::post('invoi/get_payment_history', 'InvoiceController@get_payment_history')->name('invoi.get_payment_history');
    Route::post('invoi/add_invoice', 'InvoiceController@add_invoice')->name('invoi.add_invoice');

	Route::group(['middleware' => ['super']], function(){

	});

});


