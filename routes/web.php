<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartResidentController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Rute Publik (Bisa diakses siapa saja tanpa login)
Route::get('/', [SmartResidentController::class, 'index'])->name('smartresident.index');

// 2. Rute Tamu (Hanya dapat diakses jika pengguna BELUM login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});

// 3. Rute Terproteksi (WAJIB login - dilindungi Middleware 'auth')
Route::middleware('auth')->group(function () {
    Route::get('/lapor', [SmartResidentController::class, 'create'])->name('smartresident.create');
    Route::post('/lapor/simpan', [SmartResidentController::class, 'store'])->name('smartresident.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
