<?php

use Illuminate\Support\Facades\Route;


Route::middleware('auth',\App\Http\Middleware\CheckAdminAccess::class)->prefix('admin')->group(function () {
    Route::resource('/users', \App\Http\Controllers\Admin\User\UserController::class);
});
