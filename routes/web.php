<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminPermissionController;


Route::redirect('/', '/login');


// =========================
// Login
// =========================

Route::get('/login', [UserController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [UserController::class, 'login']);


// =========================
// Protected Admin Routes
// =========================

Route::prefix('admin')->middleware('auth.custom')->group(function () {

    // =========================
    // Dashboard
    // =========================

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware('permission:dashboard,read');


    // =========================
    // Admin CRUD
    // =========================

    Route::get('/admins', [AdminController::class, 'index'])
        ->name('admins.index')
        ->middleware('permission:admins,read');

    Route::get('/admins/create', [AdminController::class, 'create'])
        ->name('admins.create')
        ->middleware('permission:admins,read_write');

    Route::post('/admins', [AdminController::class, 'store'])
        ->name('admins.store')
        ->middleware('permission:admins,read_write');

    Route::get('/admins/{admin}/edit', [AdminController::class, 'edit'])
        ->name('admin.edit')
        ->middleware('permission:admins,read_write');

    Route::put('/admins/{admin}', [AdminController::class, 'update'])
        ->name('admins.update')
        ->middleware('permission:admins,read_write');

    Route::delete('/admins/{admin}', [AdminController::class, 'destroy'])
        ->name('admins.destroy')
        ->middleware('permission:admins,read_write');

    Route::patch('/admins/{admin}/toggle-status', [AdminController::class, 'toggleStatus'])
        ->name('admins.toggle-status')
        ->middleware('permission:admins,read_write');


    // =========================
    // Role CRUD
    // =========================

    Route::get('/roles', [RoleController::class, 'index'])
        ->name('roles.index')
        ->middleware('permission:roles,read');

    Route::get('/roles/create', [RoleController::class, 'create'])
        ->name('roles.create')
        ->middleware('permission:roles,read_write');

    Route::post('/roles', [RoleController::class, 'store'])
        ->name('roles.store')
        ->middleware('permission:roles,read_write');

    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])
        ->name('roles.edit')
        ->middleware('permission:roles,read_write');

    Route::put('/roles/{role}', [RoleController::class, 'update'])
        ->name('roles.update')
        ->middleware('permission:roles,read_write');

    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
        ->name('roles.destroy')
        ->middleware('permission:roles,read_write');

    Route::patch('/roles/{role}/toggle-status', [RoleController::class, 'toggleStatus'])
        ->name('roles.toggle-status')
        ->middleware('permission:roles,read_write');


    // =========================
    // Admin Permissions
    // =========================

    Route::get('/permissions', [AdminPermissionController::class, 'index'])
        ->name('permissions.index')
        ->middleware('permission:permissions,read');

    Route::post('/permissions/save', [AdminPermissionController::class, 'save'])
        ->name('permissions.save')
        ->middleware('permission:permissions,read_write');

    Route::get('/permissions/{admin}/get', [AdminPermissionController::class, 'getPermissions'])
        ->name('permissions.get')
        ->middleware('permission:permissions,read');


    // =========================
    // Logout
    // =========================

    Route::post('/logout', [UserController::class, 'logout'])
        ->name('logout');

});