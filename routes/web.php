<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/home', function () {
  return view('home');
})->middleware(['auth', 'verified', 'active.user'])->name('home');
Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->middleware(['auth', 'verified', 'active.user'])->name('product');
Route::middleware(['auth', 'verified', 'active.user'])->group(function () {
  Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
  Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
  Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'removeFromCart'])->name('cart.remove');
  Route::patch('/cart/{id}', [App\Http\Controllers\CartController::class, 'updateQuantity'])->name('cart.update');

  Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'checkout'])->name('checkout');
  Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
  Route::get('/checkout/success/{order}', [App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');

  Route::get('/history', [App\Http\Controllers\HistoryController::class, 'index'])->name('history');
  Route::get('/history/{order}', [App\Http\Controllers\HistoryController::class, 'show'])->name('history.show');
});

Route::middleware(['auth', 'active.user'])->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
  Route::get('/checkout/invoice/{order}', [App\Http\Controllers\CheckoutController::class, 'invoice'])->name('checkout.invoice');
});

require __DIR__ . '/auth.php';
