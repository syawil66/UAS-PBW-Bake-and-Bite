<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Edit Produk</title>
    <style>
        /* ... (Salin semua style dari create.blade.php) ... */
        body { font-family: sans-serif; margin: 20px; background: #f9f9f9; }
        h1 { color: #333; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%; padding: 8px; box-sizing: border-box;
            border: 1px solid #ccc; border-radius: 5px;
        }
        .btn { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Edit Produk: {{ $product->name }}</h1>

    @if ($errors->any())
        ...
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT') <div class="form-group">
            <label for="name">Nama Produk:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="form-group">
            <label for="category_id">Kategori:</label>
            <select id="category_id" name="category_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi:</label>
            <textarea id="description" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Harga (Rp):</label>
            <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" min="0" required>
        </div>

        <div class="form-group">
            <label for="stock">Stok:</label>
            <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required>
        </div>

        <div class="form-group">
            <label for="image">Gambar Produk (Opsional):</label>
            <p>Gambar saat ini:</p>
            @if ($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" width="150">
            @else
                <p>Tidak ada gambar.</p>
            @endif
            <p style="margin-top: 10px;">Ganti gambar (kosongkan jika tidak ingin ganti):</p>
            <input type="file" id="image" name="image">
        </div>

        <button type="submit" class="btn">Update Produk</button>
    </form>
</body>
</html>
