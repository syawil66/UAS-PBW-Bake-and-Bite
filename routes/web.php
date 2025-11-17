<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

// --- Controller Frontend ---
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;

// --- Controller Backend (Admin) ---
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;


// RUTE PUBLIK (BISA DIAKSES SIAPA SAJA)
Route::get('/', function () {
    $topSellers = Product::take(3)->get();
    return view('home', ['topSellers' => $topSellers]);
})->name('home');

// Rute statis
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contact', function () { return view('contact'); })->name('contact');

// Rute Shop & Produk
Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');
Route::get('/shop/{category:slug}', [ProductController::class, 'showCategory'])->name('shop.category');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');



// RUTE AUTENTIKASI (GUEST & USER)
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// RUTE PENGGUNA (WAJIB LOGIN)
Route::middleware(['auth'])->group(function () {

    // Rute Keranjang Belanja
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    // Rute checkout
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

});


// RUTE ADMIN (ROLE ADMIN)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('products', AdminProductController::class);
    Route::resource('categories', AdminCategoryController::class);
});
