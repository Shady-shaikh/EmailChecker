<?php

use Illuminate\Support\Facades\Route;


Route::middleware('auth',\App\Http\Middleware\CheckAdminAccess::class)->prefix('admin')->group(function () {
    Route::resource('/roles', \App\Http\Controllers\Admin\Role\RoleController::class);
});
