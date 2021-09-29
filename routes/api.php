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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::prefix('/user')->group(function(){
    Route::post('/login', 'App\Http\Controllers\AuthController@login');
    /* Route::middleware('auth:api')->get('/all', ''); */
    Route::post('/register', 'App\Http\Controllers\AuthController@register');
    Route::post('/addCustomers', 'App\Http\Controllers\CustomersController@add');
});

Route::prefix('/customer')->group(function(){

    Route::middleware('auth:api')->post('/addCustomers', 'App\Http\Controllers\CustomersController@add');
    Route::middleware('auth:api')->post('/softDelete', 'App\Http\Controllers\CustomersController@delete');
    Route::middleware('auth:api')->post('/searchCustomers', 'App\Http\Controllers\CustomersController@search');
});

/* Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signUp');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
}); */