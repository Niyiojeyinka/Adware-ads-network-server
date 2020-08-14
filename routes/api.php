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
Route::prefix('user')
    ->middleware([])
    ->group(function () {
        Route::post('register', 'UserAuthController@register');
        Route::post('logout', 'UserAuthController@logout');
        Route::post('login', 'UserAuthController@login');
    });
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});