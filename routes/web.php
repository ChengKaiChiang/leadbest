<?php

use Illuminate\Support\Facades\Route;

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

Route::get('test', 'TestController@index');
Route::post('/getPrimeFactor', 'TestController@printNumbers');

Route::apiResource('balance', 'BalanceController');
Route::post('transfer', 'BalanceLogController@transfer');
Route::get('balance-log', 'BalanceLogController@index');
