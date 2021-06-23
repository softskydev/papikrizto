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

Route::get('/', 'LoginController@admin_index');
Route::post('/login/process', 'LoginController@admin_process');

Route::get('/dashboard' , 'DashboardController@index')->name('dashboard');

// Route::get('/product' , 'ProductController@index')->name('product');
// Route::get('/product/new' , 'ProductController@create')->name('productcreate');
// Route::post('/product/store' , 'ProductController@store')->name('productstore');

Route::resource('product' , 'ProductController');
Route::resource('product_stock' , 'ProductStockController');
Route::resource('stock' , 'StockController');
Route::resource('sales' , 'SalesController');

Route::get('branch/create/{id}', 'BranchController@create');
Route::get('branch/edit/{id}', 'BranchController@edit');
Route::resource('branch' , 'BranchController', ['except' => ['create', 'edit']]);

Route::resource('transaction', 'TransactionController');
Route::get('transaction/json_price/{stock_id}', 'TransactionController@json_price');
Route::get('transaction/json_stock/{product_id}', 'TransactionController@json_stock');
Route::get('transaction/json_product/all', 'TransactionController@json_product');