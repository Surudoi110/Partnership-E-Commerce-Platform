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

// user customer routes
Route::middleware(['auth'])->group(function () {
    // cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{itemId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');
});

// user seller routes
Route::middleware(['auth'])->group(function () {

    // Product management for any user
    Route::get('/my/products', [ProductController::class, 'index'])->name('my.products');
    Route::get('/my/products/create', [ProductController::class, 'create'])->name('my.products.create');
    Route::post('/my/products/store', [ProductController::class, 'store'])->name('my.products.store');
    Route::get('/my/products/{id}/edit', [ProductController::class, 'edit'])->name('my.products.edit');
    Route::put('/my/products/{id}', [ProductController::class, 'update'])->name('my.products.update');
    Route::delete('/my/products/{id}', [ProductController::class, 'destroy'])->name('my.products.destroy');
});


// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    // admin dashboard (idk what to add)
});

Route::prefix('/register')->group(function(){
    Route::get('/signup', function(){

    });

    Route::get('/login', function(){
        
    });
});