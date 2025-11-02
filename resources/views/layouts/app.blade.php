<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bake&Bite</title>
    <style>
        /* Reset Dasar */
        body, h1, h2, h3, p, ul, li {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #E6E0D4; /* Warna teks utama (krem) */
        }

        body {
            background-color: #1A1A1A; /* Latar belakang gelap */
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
            color: #C0A98E; /* Warna hover coklat muda */
        }

        .navbar-cart {
            /* Kita bisa tambahkan ikon keranjang di sini */
            font-weight: 500;
        }

        /* === FOOTER === */
        .footer {
            background-color: #0F0F0F; /* Warna footer lebih gelap */
            padding: 60px 0;
            margin-top: 100px;
        }

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
                <a href="{{ route('cart') }}">Cart (0)</a>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-col">
                <h4>Bake&Bite</h4>
                <p>Freshly baked bread and pastries, made with love and the finest ingredients.</p>
            </div>
            <div class="footer-col">
                <h4>Navigation</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('shop.index') }}">Shop</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contact Us</h4>
                <ul>
                    <li><p>123 Bakery Street, Jakarta</p></li>
                    <li><p>hello@bakeandbite.com</p></li>
                    <li><p>+62 123 4567 890</p></li>
                </ul>
            </div>
        </div>
    </footer>

</body>
</html>
