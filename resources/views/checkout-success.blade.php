@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 50px; padding-bottom: 50px; min-height: 50vh; text-align: center;">

    <h1 style="font-size: 48px; font-family: serif; color: #E6E0D4; margin-bottom: 20px;">
        Thank You!
    </h1>
    <p style="font-size: 18px; color: #A0A0A0; margin-bottom: 30px;">
        Pesanan Anda telah kami terima dan akan segera kami proses.
    </p>

    <a href="{{ route('shop.index') }}" class="btn-primary"
        style="background-color: #E6E0D4; color: #1A1A1A; padding: 15px 35px; border-radius: 30px; font-weight: bold; text-decoration: none;">
        Kembali ke Toko
    </a>
</div>
@endsection
