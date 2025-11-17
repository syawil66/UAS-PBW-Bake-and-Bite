@extends('layouts.app')

@section('content')

{{-- CSS Khusus untuk kartu kategori --}}
<style>
    .shop-header {
        padding-top: 50px;
        padding-bottom: 30px;
    }
    .shop-header h1 {
        font-family: serif;
        font-size: 60px;
        font-weight: normal;
        text-align: center;
    }

    /* Kartu untuk Kategori */
    .category-card {
        background: #2a2a2a; /* Warna abu-abu gelap */
        border-radius: 15px;
        border: 1px solid #444;
        overflow: hidden;
        text-align: center;
        transition: transform 0.3s ease;
    }
    .category-card:hover {
        transform: translateY(-5px);
    }

    .category-card img {
        width: 100%;
        height: 350px;
        object-fit: cover;
    }

    .category-card h3 {
        font-size: 28px;
        font-weight: normal;
        font-family: serif;
        color: #E6E0D4;
        margin: 20px;
    }
</style>

<div class="container">

    <div class="shop-header">
        <h1>Our Categories</h1>
    </div>

    <div class="product-grid" style="grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));">

        @forelse ($categories as $category)
            <a href="{{ route('shop.category', $category->slug) }}" class="category-card">
                {{-- Ini BENAR (menggunakan titik) --}}
                    <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}">
                <h3>{{ $category->name }}</h3>
            </a>
        @empty
            <p style="text-align: center; grid-column: 1 / -1; color: #A0A0A0;">
                Belum ada kategori untuk ditampilkan.
            </p>
        @endforelse

    </div>

</div>
@endsection
