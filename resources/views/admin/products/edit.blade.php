@extends('layouts.admin')

@section('content')
    <h1>Edit Produk: {{ $product->name }}</h1>

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

    <div class="form-wrapper">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nama Produk:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            </div>
            <div class="form-group">
                <label for="category_id">Kategori:</label>
                <select id="category_id" name="category_id" required>
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
                @if ($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" style="max-width: 150px; border-radius: 5px; margin-bottom: 10px; display: block;">
                @else
                    <p>Tidak ada gambar.</p>
                @endif
                <input type="file" id="image" name="image">
                <small>Kosongkan jika tidak ingin mengganti gambar.</small>
            </div>
            <button type="submit" class="btn">Update Produk</button>
        </form>
    </div>
@endsection
