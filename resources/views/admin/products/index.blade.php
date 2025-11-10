<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Kelola Produk</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background: #f9f9f9; }
        h1 { color: #333; }
        .btn { padding: 8px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; }
        .btn-edit { background: #ffc107; }
        .btn-delete { background: #dc3545; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h1>Manajemen Produk</h1>
    <a href="{{ route('admin.products.create') }}" class="btn">
        + Tambah Produk Baru
    </a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'Belum ada kategori' }}</td>
                    <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-edit">
                            Edit
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
