<?php

use Illuminate\Support\Facades\Route;


Route::middleware('auth',\App\Http\Middleware\CheckAdminAccess::class)->prefix('admin')->group(function () {
    Route::resource('/plans', \App\Http\Controllers\Admin\Plan\PlanController::class);
});
