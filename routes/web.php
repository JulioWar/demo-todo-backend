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


Auth::routes();

Route::middleware('auth')->group(function() {

    Route::get('/', 'TaskController@index');
    Route::get('tasks/{date}', 'TaskController@getByDate');
    Route::post('tasks','TaskController@store');
    Route::post('tasks/{date}/edit','TaskController@edit');
    Route::post('tasks/delete','TaskController@destroy');
    Route::post('tasks/done','TaskController@done');
    Route::post('tasks/update','TaskController@update');

});
