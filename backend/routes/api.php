<?php

use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserController;
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

Route::middleware(['api'])->prefix("auth")
    ->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('forget', [AuthController::class, 'forget_password']);
        Route::post('reset', [AuthController::class, 'reset']);
    });

//user protected route :authentication
Route::middleware(['api', 'auth'])->prefix("auth")
    ->group(function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('refresh', [AuthController::class, 'refresh']);
    });
//user protected route :dashboard

Route::middleware(['api', 'auth'])->group(function () {

    Route::put('profile', [UserController::class, 'edit']);
    Route::get('profile/{id}', [UserController::class, 'show']);
    Route::post('pin', [UserController::class, 'setPin']);
    Route::get('offer/', [OfferController::class, 'index']);
    Route::get('offer/{id}', [OfferController::class, 'show']);
    Route::post('offer', [OfferController::class, 'store']);
    //Route::delete('offer/{id}', [OfferController::class, 'delete']);
    Route::put('offer/{id}', [OfferController::class, 'update']);
    Route::get('order/', [OrderController::class, 'index']);
    Route::get('order/{id}', [OrderController::class, 'show']);
    Route::post('order/{offer}', [OrderController::class, 'buy']);                                                               //buy currency(RMB)
    Route::get('sale', [SaleController::class, 'index']);
    Route::get('sale/{id}', [SaleController::class, 'show']);
    Route::get('transfer', [TransferController::class, 'index']);
    Route::post('transfer', [TransferController::class, 'store']);
    Route::get('transfer/{id}', [TransferController::class, 'show']);

});

//public routes
Route::middleware(['api'])->group(function () {
    Route::get('currency', [CurrencyController::class, 'index']);
    Route::get('country', [CountryController::class, 'index']);
});

//routes for admin
Route::middleware(['api'])->prefix('admin')->group(function () {
    Route::post('login', [AuthAdminController::class, 'login']);
});
