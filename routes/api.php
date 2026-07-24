<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use App\Http\Controllers\Api\CustomerApiController;
use App\Http\Controllers\Api\VehicleApiController;
use App\Http\Controllers\Api\TransactionApiController;


Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Email atau password salah'], 401);
    }

    return response()->json([
        'token' => $user->createToken('auth_token')->plainTextToken
    ]);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/customers', [CustomerApiController::class, 'index']);
    Route::get('/vehicles', [VehicleApiController::class, 'index']);
    Route::get('/transactions', [TransactionApiController::class, 'index']);
});