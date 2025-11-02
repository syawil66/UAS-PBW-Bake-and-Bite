<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;


// Rute untuk Landing Page (Home)
Route::get('/', function () {
    $topSellers = \App\Models\Product::take(3)->get();

    return view('home', ['topSellers' => $topSellers]);
})->name('home');

Route::get('/shop', [App\Http\Controllers\ProductController::class, 'index'])->name('shop.index');

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
