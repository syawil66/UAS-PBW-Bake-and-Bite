<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // 1. Ambil semua kategori dari database
        $categories = Category::all();
        // 2. Tampilkan view
        return view('shop.index', ['categories' => $categories]);
    }

    public function showCategory(Category $category)
    {
        // 1. Muat produk terkait kategori ini
        $category->load('products');

        // 2. Tampilkan view
        return view('shop.category', [
            'category' => $category,
            'products' => $category->products
        ]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product-detail', ['product' => $product]);
    }
}
