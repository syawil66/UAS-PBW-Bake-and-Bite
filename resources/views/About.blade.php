@extends('layouts.app2')

@section('content')

{{--
    CATATAN:
    Untuk tampilan yang benar-benar SAMA PERSIS dengan gambar asli (papan kayu, roti di bawah),
    kamu harus menempatkan background image papan kayu dan gambar barisan roti di path 'images/' kamu.
--}}

<style>
    .hero-boulangerie {

        text-align: center;
        background-image: url("{{ asset('Pictures/p.jpg') }}");

    }

    .hero-boulangerie h1 {
        font-family: 'Playfair Display', serif; /* Font yang aku gunakan sebelumnya */
        font-size: 56px;
        color: #4B4B4B; /* Warna abu-abu gelap agar terlihat di latar putih */
        margin-bottom: 30px;
    }

    .hero-boulangerie h2 {
        font-family: 'Lato', sans-serif;
        font-size: 24px;
        color: #4B4B4B;
        font-weight: 400;
        margin-bottom: 40px;
    }

    .btn-visit-shops {
        display: inline-block;
        padding: 10px 30px;
        border: 2px solid #4B4B4B;
        color: #4B4B4B;
        text-decoration: none;
        font-size: 16px;
        letter-spacing: 1px;
        transition: all 0.3s;
    }

    .btn-visit-shops:hover {
        background-color: #4B4B4B;
        color: white;
    }

    /* Barisan Roti di Bagian Bawah */
    .baking-goods-bar {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 180px; /* Sesuai tinggi barisan roti di gambar */
        /* Ganti dengan gambar barisan roti yang kamu miliki (idealnya PNG transparan) */
        background-image: url("{{ asset('images/baking_goods_bar.png') }}");
        background-size: cover;
        background-position: bottom center;
        background-repeat: no-repeat;
    }

    .container-mid{
        margin-top: 150px;
    }
</style>

<div class="hero-boulangerie">
<div class="container-mid">
        {{-- Judul Besar --}}
        <h1 style="color: rgb(0, 0, 0);">The Authentic French Boulangerie</h1>

        {{-- Sub Judul --}}
        <h2 style="color: rgb(0, 0, 0)">Baked with love and tradition, brought from France to you</h2>

        {{-- Tombol --}}
        <a href="{{ route('shop.index') }}" class="btn-visit-shops" style="color: rgb(0, 0, 0)">Visit Our Shops</a>
    </div>

    {{-- Barisan Roti di Bagian Bawah --}}
    <div class="baking-goods-bar"></div>

</div>



@endsection



