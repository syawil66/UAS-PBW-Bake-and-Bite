@extends('layouts.app')

@section('content')

{{-- CSS tambahan khusus untuk halaman shop --}}
<style>
    .shop-header {
        padding-top: 50px;
        padding-bottom: 30px;
    }
    .shop-header h1 {
        font-family: serif;
        font-size: 60px;
        font-weight: normal;

        /* Memberi efek panah kembali seperti di gambar */
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .shop-header h1::before {
        content: '<';
        font-size: 40px;
        font-weight: 200;
        cursor: pointer;
        transition: transform 0.2s;
    }
    .shop-header h1:hover::before {
        transform: translateX(-5px);
    }
</style>

<div class="container">

    <div class="shop-header">
        <h1>{{ $category->name }}</h1>
    </div>

    <div class="product-grid">

        {{-- Loop semua produk dari database --}}
        @forelse ($products as $product)
            <div class="product-card">

                {{-- Link ke halaman detail --}}
                <a href="{{ route('product.show', ['id' => $product->id]) }}">
                    <img src="{{ asset('images/' . $product->image_path) }}" alt="{{ $product->name }}">
                </a>

                <h3>
                    {{-- Link ke halaman detail --}}
                    <a href="{{ route('product.show', ['id' => $product->id]) }}">
                        {{ $product->name }}
                    </a>
                </h3>

                <p class="price">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn-white">Add To Cart</button>
                </form>
            </div>
        @empty
            <p style="text-align: center; grid-column: 1 / -1; color: #A0A0A0;">
                Belum ada produk di kategori ini.
            </p>
        @endforelse

    </div>

</div>

{{-- Script untuk tombol 'back' (panah <) --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const backButtonTrigger = document.querySelector('.shop-header h1');
        if (backButtonTrigger) {
            backButtonTrigger.addEventListener('click', function(e) {
                // Pastikan yang diklik adalah area judul
                if (e.target.tagName === 'H1' || e.target.tagName === '::before') {
                    // Kembali ke halaman sebelumnya
                    window.history.back();
                }
            });
        }
    });
</script>
@endsection
