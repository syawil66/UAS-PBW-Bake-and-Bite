@extends('layouts.admin')

@section('content')
    <h1>Tambah Produk Baru</h1>

    @if ($errors->any())
        <div style="color: red; background: #ffebee; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            <strong>Whoops! Ada masalah:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nama Produk:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="category_id">Kategori:</label>
            <select id="category_id" name="category_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi:</label>
            <textarea id="description" name="description" rows="5">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Harga (Rp):</label>
            <input type="number" id="price" name="price" value="{{ old('price') }}" min="0" required>
        </div>
        <div class="form-group">
            <label for="stock">Stok:</label>
            <input type="number" id="stock" name="stock" value="{{ old('stock') }}" min="0" required>
        </div>
        <div class="form-group">
            <label for="image">Gambar Produk:</label>
            <input type="file" id="image" name="image" required>
        </div>
        <button type="submit" class="btn">Simpan Produk</button>
    </form>
@endsection
