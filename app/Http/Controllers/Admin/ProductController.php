<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua produk beserta kategori terkait
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Kita butuh daftar kategori untuk ditampilkan di dropdown
        $categories = Category::all();
        return view('admin.products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Validasi gambar
        ]);

        // 2. Handle Upload Gambar (Sesuai rencana storage:link Anda)
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan di: storage/app/public/products/
            // 'products' adalah nama folder di dalam 'public'
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // 3. Simpan ke Database
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image_path' => $imagePath, // Simpan path gambarnya
        ]);

        // 4. Redirect kembali ke halaman index
        return redirect()->route('admin.products.index')
                        ->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // 1. Validasi data (gambar tidak 'required' saat update)
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 'nullable'
        ]);

        // 2. Siapkan data untuk di-update
        $updateData = $request->except('image'); // Ambil semua data kecuali gambar

        // 3. Handle jika ada gambar baru yang di-upload
        if ($request->hasFile('image')) {
            // A. Hapus gambar lama (jika ada)
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            // B. Simpan gambar baru
            $imagePath = $request->file('image')->store('products', 'public');
            $updateData['image_path'] = $imagePath; // Tambahkan path baru ke data update
        }

        // 4. Update data di database
        $product->update($updateData);

        // 5. Redirect kembali ke halaman index
        return redirect()->route('admin.products.index')
                        ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // 1. Hapus gambar dari storage
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        // 2. Hapus produk dari database
        $product->delete();

        // 3. Redirect kembali
        return redirect()->route('admin.products.index')
                        ->with('success', 'Produk berhasil dihapus!');
    }
}
