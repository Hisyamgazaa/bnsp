<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use Illuminate\Support\Facades\Route;

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
  Route::middleware('guest')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
  });

  Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Dashboard routes (for backward compatibility)
    Route::get('orders', [AdminDashboardController::class, 'orders'])->name('orders');
    Route::get('products', [AdminDashboardController::class, 'products'])->name('products');

    // User Management Routes
    Route::prefix('users')->name('users.')->group(function () {
      Route::get('/', [UserManagementController::class, 'index'])->name('index');
      Route::get('create', [UserManagementController::class, 'create'])->name('create');
      Route::post('/', [UserManagementController::class, 'store'])->name('store');
      Route::get('{user}', [UserManagementController::class, 'show'])->name('show');
      Route::get('{user}/edit', [UserManagementController::class, 'edit'])->name('edit');
      Route::put('{user}', [UserManagementController::class, 'update'])->name('update');
      Route::delete('{user}', [UserManagementController::class, 'destroy'])->name('destroy');
      Route::patch('{user}/toggle-status', [UserManagementController::class, 'toggleStatus'])->name('toggle-status');
    });
  });
});
