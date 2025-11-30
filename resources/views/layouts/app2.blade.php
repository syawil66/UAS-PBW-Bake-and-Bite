<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <title>Bake&Bite</title>
    <style>
        /* Reset Dasar */
        body, h1, h2, h3, p, ul, li {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #000000; /* Warna teks utama (krem) */
        }

        body {
            background-image: url("{{ asset('images/p.jpg') }}");
            background-size: cover; /* Biar penuh */
            background-position: center; /* Fokus di tengah */
            background-repeat: no-repeat; /* Tidak berulang */
            background-attachment: fixed; /* Biar tetap saat scroll */

        }

        a {
            color: inherit; /* Mewarisi warna dari parent */
            text-decoration: none;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .countainer {

        }

        /* === NAVBAR === */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 0; /* Padding atas-bawah 30px, kiri-kanan 0 */
        }

        .navbar .logo {
            font-size: 28px;
            font-weight: bold;
            font-family: serif; /* Font logo lebih klasik */
        }

        .navbar-nav {
            display: flex;
            gap: 40px; /* Jarak antar menu */
            list-style-type: none; /* Hilangkan bullet points */
        }

        .navbar-nav li a {
            font-size: 18px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .navbar-nav li a:hover {
            color: #000000; /* Warna hover coklat muda */
        }

        .navbar-cart {
            /* Kita bisa tambahkan ikon keranjang di sini */
            font-weight: 500;
        }

        /* === FOOTER === */


        .footer .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }

        .footer h4 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .footer p, .footer ul li {
            margin-bottom: 10px;
            color: #A0A0A0; /* Warna teks footer lebih redup */
        }

        .footer ul {
            list-style-type: none;
        }

        /* Atur link keranjang agar ikon dan teks sejajar */
        .navbar-cart a {
            display: flex;
            align-items: center;
            gap: 8px; /* Jarak antara ikon dan teks */
        }

        /* Atur ukuran dan goresan ikon */
        .cart-icon {
            width: 28px;
            height: 28px;
            stroke: currentColor; /* Otomatis pakai warna teks link */
            stroke-width: 1.5;
            fill: none;
        }

    </style>
</head>
<body>

    <header>
        <div class="container navbar">
            <div class="logo">
                <a href="{{ route('home') }}">Bake&Bite</a>
            </div>
            <ul class="navbar-nav">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('shop.index') }}">Shop</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
            <div class="navbar-cart">
                <a href="{{ route('cart.index') }}">

                    <svg class="cart-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>

                    <span>Cart ({{ count(session('cart', [])) }})</span>
                </a>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>



</body>
</html>
