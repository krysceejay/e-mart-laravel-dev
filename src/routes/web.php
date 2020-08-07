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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/items', 'HomeController@allItems')->name('items');
Route::get('/item/{slug}', 'HomeController@item')->name('item');
Route::get('/user-cart', 'HomeController@cart')->name('user-cart');

Route::get('/cart', 'UserController@cart')->name('cart');
Route::post('/cart', 'UserController@addCart');
Route::post('/removecart','UserController@removeCart');
Route::post('/loadcart','UserController@loadCart');
Route::get('/order-received', 'UserController@orderReceived')->name('order-received');
