<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\TransactionController;

// Redirect halaman depan langsung ke dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Rute yang WAJIB Login & Terverifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Sistem Informasi Bengkel
    Route::resource('users', UserController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('transactions', TransactionController::class);
});

// File Rute Auth Bawaan Breeze (Login, Register, Logout)
require __DIR__.'/auth.php';