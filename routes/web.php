<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

Route::redirect('/', '/login');

Route::get('/login', [UserController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [UserController::class, 'login']);

Route::prefix('admin')->middleware('auth.custom')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::post('/logout', [UserController::class, 'logout'])
        ->name('logout');
});