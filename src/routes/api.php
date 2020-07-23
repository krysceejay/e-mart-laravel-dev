<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/users', 'Api\UserController@allUsers');
Route::post('/login', 'Api\UserController@userLogin');
Route::post('/register', 'Api\UserController@userRegister');
Route::post('/cart', 'Api\UserController@addCart');

Route::get('/items', 'Api\HomeController@allItems');
Route::get('/item/{slug}', 'Api\HomeController@item');
Route::get('/filteritem', 'Api\HomeController@filterItems');
