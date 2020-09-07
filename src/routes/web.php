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
Route::get('/user-checkout', 'HomeController@checkoutGet')->name('user-checkout');
Route::post('/gcheckout','HomeController@checkoutG');
Route::get('/order-received', 'HomeController@orderReceived')->name('order-received');
Route::get('/gcarts', 'HomeController@removeFromGuest');
Route::get('/filteritem', 'HomeController@filterItems')->name('filteritems');
Route::get('/reviews/{slug}', 'HomeController@allReviews')->name('reviews');


Route::post('/paystack','HomeController@paystackWebHook');


Route::get('/cart', 'UserController@cart')->name('cart');
Route::post('/cart', 'UserController@addCart');
Route::post('/removecart','UserController@removeCart');
Route::post('/updatecart', 'UserController@updateCart');
Route::post('/loadcart','UserController@loadCart');
