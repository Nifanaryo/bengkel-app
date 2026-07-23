<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CustomerApiController;
use App\Http\Controllers\Api\VehicleApiController;
use App\Http\Controllers\Api\TransactionApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/customers', [CustomerApiController::class, 'index']);
Route::get('/vehicles', [VehicleApiController::class, 'index']);
Route::get('/transactions', [TransactionApiController::class, 'index']);