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

	Route::get('clients', 'ClientController@clients');
	Route::resource('client', 'ClientController');

    Route::get('products', 'ProductController@products');
    Route::resource('product','ProductController');

    Route::get('sale', 'SaleController@index')->name('admin.sale');
    Route::get('list_products/{id}', 'SaleController@listProductsSale')->name('admin.list-products-sale');
    Route::get('client_for_sale', 'SaleController@selectClient')->name('admin.client-for-sale');
    Route::get('product_for_sale', 'SaleController@selectProduct')->name('admin.product-for-sale');
    Route::post('include_product', 'SaleController@includeProduct')->name('admin.include-product');

	Route::get('/', 'AdminController@index')->name('admin.home');
});

Route::get('/', 'Site\SiteController@index')->name('home');

Auth::routes();