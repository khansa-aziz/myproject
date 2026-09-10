
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

Route::redirect('/', '/login');


// Login
Route::get('/login', [UserController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [UserController::class, 'login']);


// Admin Routes
Route::prefix('admin')->middleware('auth.custom')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // Admin List
    Route::get('/admins', [AdminController::class, 'index'])
        ->name('admins.index');


    // Create Admin Form
    Route::get('/admins/create', [AdminController::class, 'create'])
        ->name('admins.create');


    // Store Admin
    Route::post('/admins', [AdminController::class, 'store'])
        ->name('admins.store');


    // Edit Admin Form
    Route::get('/admins/{admin}/edit', [AdminController::class, 'edit'])
        ->name('admin.edit');


    // Update Admin
    Route::put('/admins/{admin}', [AdminController::class, 'update'])
        ->name('admins.update');


    // Delete Admin
    Route::delete('/admins/{admin}', [AdminController::class, 'destroy'])
        ->name('admins.destroy');


    // Logout
    Route::post('/logout', [UserController::class, 'logout'])
        ->name('logout');
});
