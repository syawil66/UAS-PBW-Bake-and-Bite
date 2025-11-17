@extends('layouts.admin')

@section('content')
    <h1>Tambah Kategori Baru</h1>

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

@endsection
