<?php

use App\Http\Controllers\Frontend\Profile\ProfileController;
use App\Http\Controllers\MyPlan\MyPlanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend/welcome');
});


Route::get('/dashboard', function () {
    return view('frontend/welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/my-dashboard', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin/dashboard.php';
require __DIR__ . '/admin/roles.php';
require __DIR__ . '/admin/plans.php';
require __DIR__ . '/admin/users.php';

require __DIR__ . '/frontend/my-plans.php';
require __DIR__ . '/frontend/verify-emails.php';
