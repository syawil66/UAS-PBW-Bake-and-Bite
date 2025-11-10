<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

// Rute untuk Landing Page (Home)
Route::get('/', function () {
    $topSellers = \App\Models\Product::take(3)->get();

    return view('home', ['topSellers' => $topSellers]);
})->name('home');

// Rute untuk Halaman Shop
Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');
// Rute ini akan menampilkan DAFTAR PRODUK dalam satu kategori
Route::get('/shop/{category:slug}', [ProductController::class, 'showCategory'])->name('shop.category');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Rute untuk Halaman About
Route::get('/about', function () {
    return view('about');
})->name('about');

// Rute untuk Halaman Contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Rute untuk Halaman Cart
Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Rute Kerangjang Belanja
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Rute checkout
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', AdminProductController::class);
    Route::resource('categories', AdminCategoryController::class);
});
