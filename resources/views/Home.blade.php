@extends('layouts.app')

@section('content')


<style>
    /* === HERO SECTION === */
    .hero {
        /* Menggunakan gambar BREAD-1.jpg dari folder public/images */
        background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url("{{ asset('images/BREAD-1.jpg') }}");
        height: 80vh; /* 80% dari tinggi layar */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;

        /* Teks di tengah */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 0 20px;
    }

    .hero h1 {
        font-family: serif;
        font-size: 90px;
        font-weight: normal;
        color: white;
    }

    .hero p {
        font-size: 20px;
        color: white;
        max-width: 500px;
        margin: 20px 0 30px;
    }

    .hero .btn-primary {
        background-color: #E6E0D4; /* Warna krem */
        color: #1A1A1A; /* Warna teks gelap */
        padding: 15px 35px;
        border-radius: 30px;
        font-weight: bold;
        font-size: 16px;
        transition: all 0.3s;
    }

    .hero .btn-primary:hover {
        background-color: #C0A98E; /* Warna coklat muda */
    }

    .about-us {
        margin-top: 100px;
        display: flex; /* Mengaktifkan Flexbox */
        align-items: center; /* Membuat konten sejajar di tengah (vertikal) */
        gap: 60px; /* Jarak antara gambar dan teks */
    }

    .about-us-image {
        flex-basis: 50%; /* Lebar kolom gambar 50% */
        border-radius: 15px;
        overflow: hidden; /* Memastikan gambar mengikuti border-radius */
    }

    .about-us-image img {
        width: 100%;
        display: block; /* Menghilangkan spasi ekstra di bawah gambar */
    }

    .about-us-content {
        flex-basis: 50%; /* Lebar kolom teks 50% */
    }

    .about-us-content .sub-heading {
        display: block;
        font-size: 16px;
        font-weight: bold;
        color: #C0A98E; /* Warna coklat muda (subjudul) */
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }

    .about-us-content h2 {
        font-family: serif;
        font-size: 48px;
        font-weight: normal;
        margin-bottom: 20px;
    }

    .about-us-content p {
        font-size: 16px;
        color: #A0A0A0; /* Warna abu-abu krem */
        line-height: 1.6;
        margin-bottom: 30px;
    }

    /* Style untuk tombol "Read More" (Outline) */
    .btn-secondary {
        background-color: transparent;
        color: #E6E0D4; /* Warna teks krem */
        border: 2px solid #E6E0D4;
        padding: 13px 35px;
        border-radius: 30px;
        font-weight: bold;
        font-size: 16px;
        transition: all 0.3s;
    }

    .btn-secondary:hover {
        background-color: #E6E0D4;
        color: #1A1A1A; /* Balik warna saat di-hover */
    }

    Oke, lanjut!

Sekarang kita akan rapikan bagian "Top Sellers". Saat ini, kita menggunakan inline style (kode style="..." langsung di HTML), yang membuat kode berantakan dan susah diatur.

Kita akan memindahkan semua style itu ke dalam tag <style> di bagian atas, sama seperti yang kita lakukan untuk "About Us". Ini akan membuat kode HTML kita jauh lebih bersih.

File yang akan di-edit: resources/views/home.blade.php
Langkah 1: Tambahkan CSS untuk "Top Sellers"
Buka file resources/views/home.blade.php. Cari tag <style> Anda dan tambahkan kode CSS berikut di dalam tag <style> tersebut, setelah style .btn-secondary:hover.

Kode CSS (untuk ditambahkan di home.blade.php):

CSS

    /* ... style .btn-secondary:hover sebelumnya ... */

    .btn-secondary:hover {
        background-color: #E6E0D4;
        color: #1A1A1A; /* Balik warna saat di-hover */
    }

    /* === TAMBAHKAN KODE DI BAWAH INI === */

    /* === TOP SELLERS SECTION === */
    .top-sellers-section {
        margin-top: 100px;
    }

    /* Ini adalah style global untuk judul-judul section */
    .section-title {
        font-family: serif;
        font-size: 48px;
        font-weight: normal;
        text-align: center;
        margin-bottom: 40px;
    }

    /* Grid untuk produk */
    .product-grid {
        display: grid;
        /* Buat 3 kolom, atau auto-fit di layar kecil */
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    /* Kartu produk */
    .product-card {
        background: #2a2a2a; /* Warna abu-abu gelap */
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        border: 1px solid #444; /* Border tipis seperti di gambar */
        transition: transform 0.3s ease; /* Animasi hover */
    }

    .product-card:hover {
        transform: translateY(-5px); /* Sedikit terangkat saat di-hover */
    }

    .product-card img {
        width: 100%;
        aspect-ratio: 1 / 1; /* Membuat gambar selalu kotak */
        object-fit: cover; /* Mencegah gambar gepeng */
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .product-card h3 {
        font-size: 22px;
        font-weight: normal;
        margin-bottom: 5px;
        color: #E6E0D4; /* Teks krem */
    }

    .product-card .price {
        color: #A0A0A0; /* Warna abu-abu muda */
        font-size: 18px;
        margin-bottom: 20px;
    }

    /* Tombol Add to Cart (Putih) */
    .btn-white {
        display: inline-block;
        background: #fff;
        color: #1A1A1A; /* Teks gelap */
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .btn-white:hover {
        background-color: #E6E0D4; /* Hover jadi krem */
    }
</style>

<section class="hero">
    <h1>Bake&Bite</h1>
    <p>Freshly baked bread and pastries, made with love and the finest ingredients every day.</p>
    <a href="{{ route('shop.index') }}" class="btn-primary">Shop Now</a>
</section>

<section class="container about-us">

    <div class="about-us-image">
        <img src="{{ asset('images/Croissant1.jpg') }}" alt="Our Bakery">
    </div>

    <div class="about-us-content">
        <span class="sub-heading">About Us</span>
        <h2>We bake with passion and love</h2>
        <p>
            Established in 2024, Bake&Bite started with a simple mission:
            to bring joy to our community through the art of baking.
            We use only the finest local ingredients.
        </p>
        <a href="{{ route('about') }}" class="btn-secondary">Read More</a>
    </div>
</section>

<section class="container top-sellers-section">

    <h2 class="section-title">Top Sellers</h2>

    <div class="product-grid">

        @forelse ($topSellers as $product)
            <div class="product-card">
                <img src="{{ asset('images/' . $product->image_path) }}" alt="{{ $product->name }}">
                <h3>{{ $product->name }}</h3>
                <p class="price">Rp{{ number_format($product->price, 0, ',', '.') }}</p>

                <a href="#" class="btn-white">Add To Cart</a>
            </div>
        @empty
            <p style="text-align: center; grid-column: 1 / -1; color: #A0A0A0;">
                Belum ada produk untuk ditampilkan.
            </p>
        @endforelse
    </div>
</section>

@endsection
