<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

// auth routes
require __DIR__ . '/auth.php';

// main routes
Route::redirect('/', '/login');

// dashboard routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
