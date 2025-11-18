@extends('layouts.admin')

@section('content')
    <div class="header-actions">
        <h1>Manajemen Kategori</h1>
    </div>

    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.categories.create') }}" class="btn">
            + Tambah Kategori Baru
        </a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary" style="margin-left: 10px;">
            Kembali ke Manajemen Produk
        </a>
    </div>

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
            @endforelse
        </tbody>
    </table>

@endsection
