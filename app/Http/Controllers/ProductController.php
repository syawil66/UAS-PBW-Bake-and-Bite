<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // 1. Ambil semua data produk dari database
        $products = Product::all();

        // 2. Kirim data produk ke view 'shop.blade.php'
        return view('shop', ['products' => $products]);
    }
}
