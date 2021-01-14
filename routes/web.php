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

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::post('/wallet/{id}/update', 'WalletController@update')->name('wallet.update');
Route::post('/deposit/store', 'DepositController@store')->name('deposit.store');
Route::post('/test', 'DepositController@test')->name('deposit.test');
