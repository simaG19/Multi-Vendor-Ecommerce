<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

use App\Http\Controllers\PublicVendorController;



    use App\Http\Controllers\CartController;

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');


// Home page
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});




use App\Http\Controllers\OrderController;

// existing cart routes should stay (cart.index, cart.add, cart.update, cart.remove)
// Checkout endpoint (POST)
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

// Public order lookup

// Optional short form where user can paste their order id and go to the public page
Route::get('/order/check', [OrderController::class, 'checkForm'])->name('order.check.form');

Route::post('/order/check', [OrderController::class, 'checkRedirect'])->name('order.check.redirect');

Route::get('/order/{order_number}', [OrderController::class, 'publicShow'])->name('order.public.show');


use App\Http\Controllers\PublicProductController;
// use App\Http\Controllers\CartController;

Route::get('/', [PublicProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [PublicProductController::class, 'show'])->name('products.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');




// Route::middleware('auth')->group(function () {
//     Route::get('/checkout', [CartController::class, 'showCheckout'])->name('cart.checkout.form');
//     Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
// });



use App\Http\Controllers\VendorRegistrationController;
use App\Http\Controllers\Admin\VendorController as AdminVendorController;

/*
 * Public vendor registration (no middleware)
 */
Route::get('vendor/register', [VendorRegistrationController::class, 'show'])->name('vendor.register');
Route::post('vendor/register', [VendorRegistrationController::class, 'store'])->name('vendor.register.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Vendor\DashboardController as VendorDashboard;
use App\Http\Controllers\Vendor\OrderController as VendorOrderController;

use App\Http\Controllers\Admin\OrderController as AdminOrderController;

Route::get('/admin/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

// Admin routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        // add admin resource routes here later4
        Route::get('vendors', [AdminVendorController::class, 'index'])->name('vendors.index');
        // admin vendor edit/update
Route::get('vendors/{vendor}/edit', [AdminVendorController::class, 'edit'])->name('vendors.edit');
Route::put('vendors/{vendor}', [AdminVendorController::class, 'update'])->name('vendors.update');
// admin vendor delete
Route::delete('vendors/{vendor}', [AdminVendorController::class, 'destroy'])->name('vendors.destroy');

        Route::get('vendors/{vendor}', [AdminVendorController::class, 'show'])->name('vendors.show');

        Route::post('vendors/{vendor}/approve', [AdminVendorController::class, 'approve'])->name('vendors.approve');
        Route::post('vendors/{vendor}/reject', [AdminVendorController::class, 'reject'])->name('vendors.reject');
        Route::get('orders', [VendorOrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [VendorOrderController::class, 'show'])->name('orders.show');
           Route::resource('products', AdminProductController::class)->except(['show']);
Route::delete('products/{product}/images/{image}', [AdminProductController::class,'destroyImage'])->name('products.images.destroy');


Route::get('/admin/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');


Route::get('my/orders', [AdminOrderController::class,'index'])->name('orders.index');
Route::get('my/orders/{order}', [AdminOrderController::class,'show'])->name('orders.show');
Route::post('my/orders/{order}/status', [AdminOrderController::class,'updateStatus'])->name('orders.updateStatus');


    });

// Vendor routes
// Route::prefix('vendor')
//     ->name('vendor.')
//     ->middleware(['auth', 'role:vendor'])
//     ->group(function () {
//         Route::get('/dashboard', [VendorDashboard::class, 'index'])->name('dashboard');
//         // add vendor product CRUD routes here later
//     });


   use App\Http\Controllers\Vendor\ProductController as VendorProductController;
// use App\Http\Controllers\Vendor\OrderController as VendorOrderController;
use App\Http\Controllers\Vendor\DashboardController as VendorDashboardController;

Route::prefix('vendor')
    ->name('vendor.')
    // ->middleware(['auth', 'role:vendor'])
    ->group(function () {
        // dashboard
        Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');

        // vendor product CRUD
        Route::resource('products', VendorProductController::class)->names('products');

        // delete a product image (explicit)
        Route::delete('products/{product}/images/{image}', [VendorProductController::class, 'destroyImage'])
            ->name('products.images.destroy');

        // vendor orders (index + show)
        Route::get('orders', [VendorOrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [VendorOrderController::class, 'show'])->name('orders.show');
        // inside Route::prefix('vendor')->name('vendor.')->middleware(['auth','role:vendor'])->group(...)
// vendor/orders/{order}/status
Route::post('orders/{order}/status', [VendorOrderController::class, 'updateStatus'])
    ->name('orders.updateStatus');

    });

// Public vendor profile
// Public vendor profile
Route::get('vendor/{vendor}', [PublicVendorController::class, 'show'])
    ->name('public.vendor.show');

// Public vendor products listing
Route::get('vendor/{vendor}/products', [PublicVendorController::class, 'products'])
    ->name('public.vendor.products.index');
