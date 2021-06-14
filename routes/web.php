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
Route::get('/dashboard' , 'DashboardController@index')->name('dashboard');

// Route::get('/product' , 'ProductController@index')->name('product');
// Route::get('/product/new' , 'ProductController@create')->name('productcreate');
// Route::post('/product/store' , 'ProductController@store')->name('productstore');

Route::resource('product' , 'ProductController');
Route::resource('product_stock' , 'ProductStockController');

