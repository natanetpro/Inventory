<?php

use App\Http\Controllers\Konfigurasi\ManajemenModulController;
use App\Http\Controllers\Konfigurasi\ManajemenUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('konfigurasi')->name('konfigurasi.')->group(function () {
    Route::get('manajemen-users/{id}', [ManajemenUserController::class, 'find'])->name('manajemen-user.find');

    Route::get('manajemen-moduls/{id}', [ManajemenModulController::class, 'find'])->name('manajemen-modul.find');
});
