<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Edit Kategori</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background: #f9f9f9; }
        h1 { color: #333; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 5px; }
        .btn { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Edit Kategori: {{ $category->name }}</h1>

    @if ($errors->any())
       ... @endif

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <div class="form-group">
            <label for="name">Nama Kategori:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        </div>

        <div class="form-group">
            <label for="image">Gambar Kategori (Opsional):</label>
            <p>Gambar saat ini:</p>
            <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" width="150">
            <p style="margin-top: 10px;">Ganti gambar (kosongkan jika tidak ingin ganti):</p>
            <input type="file" id="image" name="image">
        </div>

        <button type="submit" class="btn">Update Kategori</button>
    </form>
</body>
</html>
