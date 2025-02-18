<?php

use App\Http\Controllers\Frontend\VerifyEmail\VerifyEmailController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::resource('/verify-emails', VerifyEmailController::class);
});
