@extends('layouts.app')

@section('content')

{{-- CSS Khusus untuk halaman detail --}}
<style>
    .product-detail-container {
        padding-top: 50px;
        display: flex; /* Menggunakan Flexbox untuk 2 kolom */
        gap: 60px;
        align-items: flex-start; /* Konten align ke atas */
    }

    /* Kolom kiri (Teks) */
    .product-info {
        flex-basis: 50%; /* Lebar 50% */
    }

    .product-info h1 {
        font-family: serif;
        font-size: 60px;
        font-weight: normal;

        /* Memberi efek panah kembali */
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 10px;
    }

    .product-info h1::before {
        content: '<';
        font-size: 40px;
        font-weight: 200;
        cursor: pointer;
        transition: transform 0.2s;
    }
    .product-info h1:hover::before {
        transform: translateX(-5px);
    }

    .product-info .price {
        font-size: 24px;
        color: #A0A0A0; /* Abu-abu muda */
        margin-bottom: 30px;
    }

    .product-info .description-title {
        font-size: 20px;
        font-weight: bold;
        color: #E6E0D4; /* Krem */
        margin-top: 40px;
        margin-bottom: 15px;
    }

    .product-info .description-text {
        font-size: 16px;
        color: #A0A0A0; /* Abu-abu muda */
        line-height: 1.6;
    }

    /* Ini untuk styling list (poin-poin) */
    .description-text ul {
        list-style-position: inside;
        padding-left: 5px; /* Sedikit padding */
    }
    .description-text li {
        margin-bottom: 10px;
    }

    /* Kolom kanan (Gambar) */
    .product-image {
        flex-basis: 50%; /* Lebar 50% */
    }
    .product-image img {
        width: 100%;
        border-radius: 15px;
    }
</style>

<div class="container product-detail-container">

    <div class="product-info">
        <h1>{{ $product->name }}</h1>
        <p class="price">Rp{{ number_format($product->price, 0, ',', '.') }}</p>

        <form action="{{ route('cart.add') }}" method="POST">
            @csrf <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="btn-white">Add To Cart</button>
        </form>

        <h3 class="description-title">{{ $product->name }}</h3>

        <div class="description-text">
            {!! nl2br(e($product->description)) !!}
        </div>
    </div>

    <div class="product-image">
        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
    </div>

</div>

{{-- Script untuk tombol 'back' (panah <) --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const backButtonTrigger = document.querySelector('.product-info h1');
        if (backButtonTrigger) {
            backButtonTrigger.addEventListener('click', function(e) {
                // Pastikan yang diklik adalah area judul, bukan tombol "Add to Cart"
                if (e.target.tagName === 'H1' || e.target.tagName === '::before') {
                    // Kembali ke halaman sebelumnya
                    window.history.back();
                }
            });
        }
    });
</script>

@endsection
