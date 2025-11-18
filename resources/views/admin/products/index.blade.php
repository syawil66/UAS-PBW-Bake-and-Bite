@extends('layouts.admin')

@section('content')

    <div class="header-actions">
        <h1>Manajemen Produk</h1>
        <a href="{{ route('admin.products.create') }}" class="btn">+ Tambah Produk Baru</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Gambar</th>
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
                    <td>
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-edit">Edit</a>

                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline-block; margin-top: 5px;">
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
                    <td colspan="6" style="text-align: center;">Belum ada produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
