<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// Public routes
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');
// Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Static pages
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

// Customer routes
Route::middleware(['auth'])->group(function () {
    // cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{itemId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');
});

// Seller routes
Route::middleware(['auth', 'role:seller'])->group(function () {
    // product management
    Route::get('/seller/products', [ProductController::class, 'index'])->name('seller.products');
    Route::get('/seller/products/create', [ProductController::class, 'create'])->name('seller.products.create');
    Route::post('/seller/products/store', [ProductController::class, 'store'])->name('seller.products.store');
    Route::get('/seller/products/{id}/edit', [ProductController::class, 'edit'])->name('seller.products.edit');
    Route::put('/seller/products/{id}', [ProductController::class, 'update'])->name('seller.products.update');
    Route::delete('/seller/products/{id}', [ProductController::class, 'destroy'])->name('seller.products.destroy');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    // admin dashboard (idk what to add)
});