<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:web,admin', 'prevent-back'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
    
    // User auth routes
    Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    
    // Admin auth routes
    Route::get('user/login', [UserAuthController::class, 'showLoginForm'])->name('user.login');
    Route::post('user/login', [UserAuthController::class, 'login'])->name('user.login.submit');
});


Route::middleware('auth.admin')->prefix('admin')->group(function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('admin.dashboard');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('group/add', [GroupController::class, 'add'])->name('admin.group.add');
    Route::post('group/store', [GroupController::class, 'store'])->name('admin.group.store');
    Route::get('groups', [GroupController::class, 'index'])->name('admin.group.index');
    Route::delete('group/delete/{group}', [GroupController::class, 'destroy'])->name('admin.group.delete');
    Route::get('user/add', [UserController::class, 'add'])->name('admin.user.add');
    Route::post('user/store', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('user/edite/{user}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::patch('user/update/{user}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('user/delete/{user}', [UserController::class, 'destroy'])->name('admin.user.delete');
    Route::get('manage-permissions', [AppController::class, 'syncPermissions'])->name('permissions.manage');
    Route::post('save-permissions', [AppController::class, 'savePermissions'])->name('permissions.save');
});

Route::middleware('auth.user')->prefix('user')->group(function () {
    Route::get('dashboard', [UserAuthController::class, 'index'])->name('user.dashboard');
    Route::post('user/logout', [UserAuthController::class, 'logout'])->name('user.logout');
});