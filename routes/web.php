<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\UserController;   // uncomment when you add user routes
// use App\Http\Controllers\AdminController;  // uncomment when you add admin routes

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

// Home page (featured or latest products)
Route::get('/', [ProductController::class, 'index'])->name('products.index');

// All public products (optional)
Route::get('/products', [ProductController::class, 'list'])->name('products.list');

// Product detail (route-model-binding: Product $product in controller)
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Static pages
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::prefix('me')->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('me.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('me.products.store');
});




/*
|--------------------------------------------------------------------------
| Authenticated user routes (all users can sell)
|--------------------------------------------------------------------------
*/
// Route::middleware(['auth'])->group(function () {

//     // Cart
//     Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
//     Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');         // accepts Product $product
//     Route::post('/cart/update/{item}', [CartController::class, 'update'])->name('cart.update');   // $item = cart item id or model
//     Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove'); // $item = cart item id or model

//     // "My products" (the authenticated user's product management)
    Route::get('/me/products', [ProductController::class, 'myProducts'])->name('me.products.index');
    Route::get('/me/products/create', [ProductController::class, 'create'])->name('me.products.create');
    Route::post('/me/products', [ProductController::class, 'store'])->name('me.products.store');
    Route::get('/me/products/{product}/edit', [ProductController::class, 'edit'])->name('me.products.edit');
    Route::put('/me/products/{product}', [ProductController::class, 'update'])->name('me.products.update');
    Route::delete('/me/products/{product}', [ProductController::class, 'destroy'])->name('me.products.destroy');

// });


/*
|--------------------------------------------------------------------------
| Admin routes (optional)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Example admin routes (uncomment when ready)
        // Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        // Route::resource('products', AdminProductController::class);
    });


/*
|--------------------------------------------------------------------------
| Authentication routes
|--------------------------------------------------------------------------
| If you use Laravel Breeze / Jetstream you might not need manual routes here.
| Example manual auth routes (uncomment and point to your controllers if needed):
|--------------------------------------------------------------------------
*/
Route::get('/register/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/register/login', [LoginController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/register/signup', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register/signup', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);