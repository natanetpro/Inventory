<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Konfigurasi\ManajemenMenuController;
use App\Http\Controllers\Konfigurasi\ManajemenModulController;
use App\Http\Controllers\Konfigurasi\ManajemenUserController;
use App\Http\Controllers\Daftar\SupplierDaftarController;

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

// auth routes
require __DIR__ . '/auth.php';

// main routes
Route::redirect('/', '/login');

Route::middleware('auth')->group(function () {
   
    // dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // konfigurasi routes
    Route::prefix('konfigurasi')->name('konfigurasi.')->group(function () {
        // manajemen user routes
        Route::get('/manajemen-users', [ManajemenUserController::class, 'index'])->name('manajemen-user.index');
        Route::post('/manajemen-users', [ManajemenUserController::class, 'store'])->name('manajemen-user.store');
        Route::put('/manajemen-users/{id}', [ManajemenUserController::class, 'update'])->name('manajemen-user.update');
        Route::delete('/manajemen-users/{id}', [ManajemenUserController::class, 'destroy'])->name('manajemen-user.destroy');

        // manajemen modul routes
        Route::get('/manajemen-moduls', [ManajemenModulController::class, 'index'])->name('manajemen-modul.index');
        Route::post('/manajemen-moduls', [ManajemenModulController::class, 'store'])->name('manajemen-modul.store');
        Route::put('/manajemen-moduls/{id}', [ManajemenModulController::class, 'update'])->name('manajemen-modul.update');
        Route::delete('/manajemen-moduls/{id}', [ManajemenModulController::class, 'destroy'])->name('manajemen-modul.destroy');

        // manajemen menu routes
        Route::get('/manajemen-menus', [ManajemenMenuController::class, 'index'])->name('manajemen-menu.index');
        Route::put('/manajemen-menus', [ManajemenMenuController::class, 'update'])->name('manajemen-menu.update');
    });

// konfigurasi daftar
Route::prefix('daftar')->name('daftar.')->group(function () {
Route::get('/supplier-moduls', [SupplierDaftarController::class, 'index'])->name('supplier-modul.index');
   
    
});




});
