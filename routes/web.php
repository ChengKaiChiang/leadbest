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


// Route::group(['domain' => 'test-api.leadbest.io'], function(){
//     Route::apiResource('post', 'PostController');
// });

Route::apiResource('test', 'TestController');
Route::apiResource('balance', 'BalanceController');
Route::post('transfer', 'BalanceLogController@transfer');
Route::get('balance-log', 'BalanceLogController@index');
Route::post('/getPrimeFactor', 'TestController@printNumbers');