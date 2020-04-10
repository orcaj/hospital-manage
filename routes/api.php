<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getAllCivilId', 'PatientController@getAllCivilId');
Route::post('/check_if_civilid_exist', 'PatientController@check_if_civilid_exist');
Route::post('/get_invoice_list_by_civilid_date', 'InvoiceController@get_invoice_list_by_civilid_date');
Route::post('/get_invoice_detail_for_payment', 'InvoiceController@get_invoice_detail_for_payment');
Route::post('/add_transaction_history', 'InvoiceController@add_transaction_history');