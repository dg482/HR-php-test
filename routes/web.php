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
    return view('welcome');
});


Route::get('/weather', '\App\Http\Controllers\Controller@weather')->name('weather');

Route::get('/orders', '\App\Http\Controllers\OrderController@index')->name('orders');

Route::get('/order/{id}', '\App\Http\Controllers\OrderController@edit')->name('orders_edit')
    ->where([
        'id' => '[1-90]+',
    ]);

Route::post('/order/{id}', '\App\Http\Controllers\OrderController@update')->name('order_update')
    ->where([
        'id' => '[1-90]+',
    ]);
