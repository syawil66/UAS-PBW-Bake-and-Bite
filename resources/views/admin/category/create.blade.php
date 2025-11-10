<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Tambah Kategori</title>
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
    <h1>Tambah Kategori Baru</h1>

    @if ($errors->any())
        <div style="color: red; background: #ffebee; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            <strong>Whoops! Ada masalah:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endfch
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nama Kategori:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="image">Gambar Kategori:</label>
            <input type="file" id="image" name="image" required>
        </div>
        <button type="submit" class="btn">Simpan Kategori</button>
    </form>
</body>
</html>
