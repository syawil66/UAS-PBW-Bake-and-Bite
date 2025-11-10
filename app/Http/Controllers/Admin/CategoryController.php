<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 2. Handle Upload Gambar
        $imagePath = $request->file('image')->store('categories', 'public');

        // 3. Simpan ke Database
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // Otomatis buat slug, cth: "Pastry & Croissant" -> "pastry-croissant"
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Kategori berhasil ditambahkan!');
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
    public function edit(string $id)
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Validasi
        $request->validate([
            // 'unique' harus mengabaikan ID kategori saat ini
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Opsional
        ]);

        // 2. Siapkan data update
        $updateData = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ];

        // 3. Handle jika ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($category->image_path) {
                Storage::disk('public')->delete($category->image_path);
            }
            // Simpan gambar baru
            $updateData['image_path'] = $request->file('image')->store('categories', 'public');
        }

        // 4. Update database
        $category->update($updateData);

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. Hapus gambar dari storage
        if ($category->image_path) {
            Storage::disk('public')->delete($category->image_path);
        }

        // 2. Hapus kategori dari database
        //    (Produk yang terkait akan otomatis di-set null karena migrasi kita)
        $category->delete();

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Kategori berhasil dihapus!');
    }
}
