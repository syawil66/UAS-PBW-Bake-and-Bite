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
</style>

<section class="hero">
    <h1>Bake&Bite</h1>
    <p>Freshly baked bread and pastries, made with love and the finest ingredients every day.</p>
    <a href="{{ route('shop.index') }}" class="btn-primary">Shop Now</a>
</section>

<section class="container" style="margin-top: 100px;">
    <h2 style="text-align: center; font-size: 40px; font-family: serif;">About Us</h2>
    <p style="text-align: center; margin-top: 20px;">(Konten "About Us" akan kita styling di langkah selanjutnya...)</p>
</section>

<section class="container" style="margin-top: 100px;">
    <h2 style="text-align: center; font-size: 40px; font-family: serif; margin-bottom: 40px;">Top Sellers</h2>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
        {{-- Kita looping 3 produk yang dikirim dari Route --}}
        @forelse ($topSellers as $product)
            <div style="background: #2a2a2a; border: 1px solid #444; border-radius: 15px; padding: 20px; text-align: center;">
                <img src="{{ asset('images/' . $product->image_path) }}" alt="{{ $product->name }}" style="width: 100%; border-radius: 10px;">
                <h3 style="margin: 15px 0 5px; font-size: 22px;">{{ $product->name }}</h3>
                <p style="color: #ccc; font-size: 18px;">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                <a href="#" style="background: #fff; color: #333; padding: 12px 30px; border-radius: 30px; font-weight: bold; display: inline-block; margin-top: 15px;">Add To Cart</a>
            </div>
        @empty
            <p>Belum ada produk untuk ditampilkan.</p>
        @endforelse
    </div>
</section>

@endsection
