<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bake&Bite</title>
    <style>
        body, h1, h2, h3, p, ul, li {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #E6E0D4;
        }

        body {
            background-image: url("{{ asset('images/background-texture.jpg') }}");
            background-color: #1A1A1A;
            background-size: auto;
            background-repeat: repeat;
        }

        a {
            color: inherit;
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
            padding: 30px 0;
        }

        .navbar .logo {
            font-size: 28px;
            font-weight: bold;
            font-family: serif;
        }

        .navbar-nav {
            display: flex;
            gap: 40px;
            list-style-type: none;
        }

        .navbar-nav li a {
            font-size: 18px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .navbar-nav li a:hover {
            color: #C0A98E;
        }

        .navbar-cart {
            font-weight: 500;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .product-card {
            background: #2a2a2a;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            border: 1px solid #444;
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card img {
            width: 100%;
            aspect-ratio: 1 / 1;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .product-card h3 {
            font-size: 22px;
            font-weight: normal;
            margin-bottom: 5px;
            color: #E6E0D4;
        }

        .product-card h3 a {
            color: inherit;
            text-decoration: none;
        }
        .product-card h3 a:hover {
            color: #C0A98E;
        }

        .product-card .price {
            color: #A0A0A0;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .btn-white {
            display: inline-block;
            background: #fff;
            color: #1A1A1A;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: bold;
            transition: background-color 0.3s;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-white:hover {
            background-color: #E6E0D4;
        }

    /* === AKHIR STYLE KARTU PRODUK === */

        /* === FOOTER === */
        .footer {
            background-color: #0F0F0F;
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
            color: #A0A0A0;
        }

        .footer ul {
            list-style-type: none;
        }

        .navbar-cart a {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .cart-icon {
            width: 28px;
            height: 28px;
            stroke: currentColor;
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
            <div class="navbar-right" style="display: flex; align-items: center; gap: 25px;">

                @guest
                    <a href="{{ route('login') }}" style="font-weight: 500; font-size: 18px;">Login</a>
                    <a href="{{ route('register') }}"
                    style="background-color: #E6E0D4; color: #1A1A1A; padding: 10px 25px; border-radius: 30px; font-weight: bold; font-size: 16px; text-decoration: none;">
                    Register
                    </a>
                @endguest

                @auth
                    <span style="font-weight: 500; font-size: 18px;">Hi, {{ Auth::user()->name }}</span>

                    @if (Auth::user()->is_admin)
                        <a href="{{ route('admin.products.index') }}" style="font-weight: bold; color: #ffc107; text-decoration: none;">Admin Panel</a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit"
                                style="background: none; border: none; color: #E6E0D4; cursor: pointer; font-size: 18px; font-weight: 500; padding: 0;">
                            Logout
                        </button>
                    </form>
                @endauth

                <div class="navbar-cart">
                    <a href="{{ route('cart.index') }}">
                        <svg class="cart-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    <span>Cart ({{ count(session('cart', [])) }})</span>
                    </a>
                </div>
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
