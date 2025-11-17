@extends('layouts.admin')

@section('content')
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

@endsection
