<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\ProductManagementController;
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

    // Product Management Routes
    Route::prefix('products')->name('products.')->group(function () {
      Route::get('/', [ProductManagementController::class, 'index'])->name('index');
      Route::get('create', [ProductManagementController::class, 'create'])->name('create');
      Route::post('/', [ProductManagementController::class, 'store'])->name('store');
      Route::get('{product}', [ProductManagementController::class, 'show'])->name('show');
      Route::get('{product}/edit', [ProductManagementController::class, 'edit'])->name('edit');
      Route::put('{product}', [ProductManagementController::class, 'update'])->name('update');
      Route::delete('{product}', [ProductManagementController::class, 'destroy'])->name('destroy');
      Route::patch('{product}/toggle-stock', [ProductManagementController::class, 'toggleStock'])->name('toggle-stock');
    });
  });
});
