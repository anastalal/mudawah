<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'v1'], function(){
    Route::post('login', 'App\Http\Controllers\UsersController@login');
    Route::post('register', 'App\Http\Controllers\UsersController@register');
    Route::get('users', 'App\Http\Controllers\UsersController@users');
    Route::get('logout', 'App\Http\Controllers\UsersController@logout')->middleware('auth:api');
   });
