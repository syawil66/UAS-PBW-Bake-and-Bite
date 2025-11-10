<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Kelola Kategori</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background: #f9f9f9; }
        h1 { color: #333; }
        .btn { padding: 8px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; }
        .btn-edit { background: #ffc107; }
        .btn-delete { background: #dc3545; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #eee; }
        img { max-width: 100px; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Manajemen Kategori</h1>
    <p>
        <a href="{{ route('admin.categories.create') }}" class="btn">
            + Tambah Kategori Baru
        </a>
        <a href="{{ route('admin.products.index') }}" class="btn" style="background: #6c757d;">
            Kembali ke Manajemen Produk
        </a>
    </p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Gambar</th>
                <th>Nama Kategori</th>
                <th>Slug (untuk URL)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}">
                    </td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus kategori ini? \n(Produk di dalamnya TIDAK akan terhapus)')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada kategori.</td>
                </tr>
            @endfelse
        </tbody>
    </table>
</body>
</html>
