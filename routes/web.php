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

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
	
	Route::post('balance/deposit', 'BalanceController@depositStore')->name('balance.store');
	Route::get('balance/deposit', 'BalanceController@deposit')->name('balance.deposit');
	Route::get('balance', 'BalanceController@index')->name('admin.balance');

	Route::get('historic/', 'HistoricController@index');
	Route::get('historic/list', 'HistoricController@historicList');

	Route::resource('clients', 'ClientController', ['names' => [
	    'index' => 'clients.index',
	    'create' => 'clients.create',
        'store' => 'clients.store',
        'show' => 'clients.show',
        'edit' => 'clients.edit',
        'update' => 'clients.update',
        'destroy' => 'clients.destroy'
    ]]);

	Route::get('/', 'AdminController@index')->name('admin.home');
});

Route::get('/', 'Site\SiteController@index')->name('home');

Auth::routes();