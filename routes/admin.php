<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\ProductManagementController;
use App\Http\Controllers\Admin\OrderManagementController;
use App\Http\Controllers\Admin\CategoryManagementController;
use Illuminate\Support\Facades\Route;

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
  Route::middleware('guest')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
  });

  Route::middleware(['auth', 'admin', 'active.user'])->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Order Management Routes
    Route::prefix('orders')->name('orders.')->group(function () {
      Route::get('/', [OrderManagementController::class, 'index'])->name('index');
      Route::get('{order}', [OrderManagementController::class, 'show'])->name('show');
      Route::patch('{order}/status', [OrderManagementController::class, 'updateStatus'])->name('update-status');
      Route::delete('{order}', [OrderManagementController::class, 'destroy'])->name('destroy');
    });

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

    // Category Management Routes
    Route::prefix('categories')->name('categories.')->group(function () {
      Route::get('/', [CategoryManagementController::class, 'index'])->name('index');
      Route::get('create', [CategoryManagementController::class, 'create'])->name('create');
      Route::post('/', [CategoryManagementController::class, 'store'])->name('store');
      Route::get('{category}', [CategoryManagementController::class, 'show'])->name('show');
      Route::get('{category}/edit', [CategoryManagementController::class, 'edit'])->name('edit');
      Route::put('{category}', [CategoryManagementController::class, 'update'])->name('update');
      Route::delete('{category}', [CategoryManagementController::class, 'destroy'])->name('destroy');
      Route::patch('{category}/toggle-status', [CategoryManagementController::class, 'toggleStatus'])->name('toggle-status');
    });
  });
});
