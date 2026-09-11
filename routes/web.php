<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;


Route::redirect('/', '/login');


// Login
Route::get('/login', [UserController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [UserController::class, 'login']);


// Protected Admin Routes
Route::prefix('admin')->middleware('auth.custom')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // =========================
    // Admin CRUD
    // =========================

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

    // Toggle Admin Status
    Route::patch('/admins/{admin}/toggle-status', [AdminController::class, 'toggleStatus'])
        ->name('admins.toggle-status');


    // =========================
    // Role CRUD
    // =========================

    // Role List
    Route::get('/roles', [RoleController::class, 'index'])
        ->name('roles.index');

    // Create Role Form
    Route::get('/roles/create', [RoleController::class, 'create'])
        ->name('roles.create');

    // Store Role
    Route::post('/roles', [RoleController::class, 'store'])
        ->name('roles.store');

    // Edit Role Form
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])
        ->name('roles.edit');

    // Update Role
    Route::put('/roles/{role}', [RoleController::class, 'update'])
        ->name('roles.update');

    // Delete Role
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
        ->name('roles.destroy');

    // Toggle Role Status
    Route::patch('/roles/{role}/toggle-status', [RoleController::class, 'toggleStatus'])
        ->name('roles.toggle-status');


    // Logout
    Route::post('/logout', [UserController::class, 'logout'])
        ->name('logout');

});