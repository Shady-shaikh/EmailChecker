<?php

use App\Http\Controllers\Frontend\MyPlan\MyPlanController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::resource('/my-plans',MyPlanController::class);
});
