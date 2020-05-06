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
    return redirect()->route('home');
});

Route::get('/datatables', 'TadabaseServicesController@index')->name('home');
Route::get('/schema/{id}/type/{name}', 'TadabaseServicesController@entity_description');
Route::get('/schema/{id}/type/{name}/detail', 'TadabaseServicesController@show')->name('schema_detail');
Route::post('/employee', 'TadabaseServicesController@store');
Route::post('/project', 'ProjectController@store');
Route::post('/customer', 'CustomerController@store');
Route::post('/job', 'JobController@store');
Route::delete('/delete_record', 'TadabaseServicesController@destroy');