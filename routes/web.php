<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', fn() => view('index'));
// Route::get('/products', fn() => view('products'));
// Route::get('/partners', fn() => view('partners'));
// Route::get('/about', fn() => view('about'));
// Route::get('/contact', fn() => view('contact'));
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');