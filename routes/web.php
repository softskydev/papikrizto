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

Auth::routes();

// Login
Route::get('/', 'LoginController@admin_index');
Route::post('/login/process', 'LoginController@admin_process');
Route::redirect('/login', '/');

// Dashboard
Route::get('/dashboard' , 'DashboardController@index')->name('dashboard');

// Cabang
Route::resource('branch' , 'BranchController');
Route::resource('admin', 'AdminController');
Route::resource('variant', 'ProductVariantController');

Route::resource('product' , 'ProductController');

Route::resource('product_stock' , 'ProductStockController');

Route::resource('stock' , 'StockController', ['except' => 'create']);
Route::get('/stock/json_variant/{branch_id}', 'StockController@json_variant');
Route::get('/stock/json_stock/{variant_id}/{product_stock_id}', 'StockController@json_stock');
Route::get('/stock/create/{variant_id}', [
	'as' => 'stock.create',
	'uses' => 'StockController@create'
]);
Route::get('/stock/detail/{variant_id}', 'StockController@detail');

Route::resource('sales' , 'SalesController');
Route::get('/sales/status/{id}/{status}', 'SalesController@set_status');

Route::resource('variant', 'ProductVariantController');
Route::get('/variant/status/{id}/{status}', 'ProductVariantController@set_status');

Route::resource('transaction', 'TransactionController');
Route::get('transaction/json_price/{stock_id}', 'TransactionController@json_price');
Route::get('transaction/json_stock/{variant_id}/{product_stock_id}', 'TransactionController@json_stock');
Route::get('transaction/json_product_stock/{variant_id}', 'TransactionController@json_product_stock');
Route::get('transaction/json_product/all', 'TransactionController@json_product');
Route::get('transaction/print/{id}', 'TransactionController@print');

Route::resource('request', 'StockRequestController');

Route::resource('account', 'AccountController');
Route::resource('hutangpiutang', 'HutangPiutangController');
Route::resource('asset', 'AssetController');

Route::get('report/stock', 'ReportController@stock');
Route::get('report/stock/print/{id}', 'ReportController@stock_print');
Route::get('report/labarugi', 'ReportController@labarugi');
Route::post('report/labarugi/print/{id}', 'ReportController@labarugi_print');
Route::get('report/neraca', 'ReportController@neraca');

Route::get('report/hutang/{category}', 'ReportController@hutang');
Route::post('report/hutang/{category}', 'ReportController@hutang');


// ajax ?

Route::get('notif/load/', 'NotifController@load_notif_all');
Route::get('request-load', 'NotifController@load_request');
