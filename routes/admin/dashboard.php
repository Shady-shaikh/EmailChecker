<?php

use Illuminate\Support\Facades\Route;


Route::middleware('auth',\App\Http\Middleware\CheckAdminAccess::class)->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
        ->name('admin.dashboard');
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
        ->name('admin.dashboard');
});
