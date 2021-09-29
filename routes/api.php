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

// Routes auth
Route::prefix('/user')->group(function(){
    Route::post('/login', 'App\Http\Controllers\AuthController@login');
    Route::post('/register', 'App\Http\Controllers\AuthController@register');
    Route::post('/addCustomers', 'App\Http\Controllers\CustomersController@add');
});

// Routes Customer services
Route::prefix('/customer')->group(function(){
    Route::middleware('auth:api')->post('/addCustomers', 'App\Http\Controllers\CustomersController@add');
    Route::middleware('auth:api')->post('/softDelete', 'App\Http\Controllers\CustomersController@delete');
    Route::middleware('auth:api')->post('/searchCustomers', 'App\Http\Controllers\CustomersController@search');
});

