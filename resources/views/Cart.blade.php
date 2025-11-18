@extends('layouts.app')

@section('content')

{{-- CSS Khusus untuk halaman keranjang --}}
<style>
    /* Reset font untuk halaman ini */
    .cart-page-container {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f1ed; /* Latar belakang krem terang */
        color: #333; /* Teks gelap */
        border-radius: 15px;
        padding: 40px;
        margin-top: 50px;
    }

    .cart-grid {
        display: grid;
        grid-template-columns: 2fr 1fr; /* Kolom kiri lebih besar */
        gap: 50px;
    }


    .cart-page-container h1, .cart-page-container h2 {
        font-family: serif;
        font-weight: normal;
        margin-bottom: 20px;
        color: #888;
        opacity: 0.8; /* Membuat teks lebih pudar */
    }

    .cart-page-container h1 { font-size: 48px; }
    .cart-page-container h2 { font-size: 32px; }


    .cart-items-section p, .checkout-section p {
        color: #555;
    }

    /* Kolom kiri: Shopping Cart */
    .cart-item {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
    }
    .cart-item img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
    }
    .cart-item-info {
        flex-grow: 1;
    }
    .cart-item-info h3 {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }

    /* Tombol kuantitas + / - */
    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .quantity-btn {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #e0e0e0;
        border: none;
        cursor: pointer;
        font-size: 18px;
    }

    .cart-item .price {
        font-size: 18px;
        font-weight: bold;
    }

    .cart-total {
        border-top: 2px solid #ccc;
        padding-top: 20px;
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 24px;
        font-weight: bold;
    }

    .checkout-btn {
        display: block;
        width: 100%;
        padding: 18px;
        background-color: #5a5a5a;
        color: white;
        text-align: center;
        border: none;
        border-radius: 10px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 30px;
    }

    /* Kolom kanan: Checkout */
    .delivery-options { display: flex; gap: 15px; margin-bottom: 30px; }
    .delivery-choice { flex: 1; padding: 20px; border: 2px solid #ccc; border-radius: 12px; background-color: #fff; cursor: pointer; text-align: center; transition: all 0.2s; }
    .delivery-choice.active { background-color: #c5b8a9; border-color: #c5b8a9; }
    .delivery-choice span { display: block; margin-top: 10px; font-weight: bold; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
    .form-group input { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px; box-sizing: border-box; }
    #delivery-form { display: none; }

    .remove-btn {
        background: none;
        border: none;
        color: #888;
        cursor: pointer;
        padding: 0;
        font-size: 14px;
        text-decoration: underline;
        margin-top: 8px;
        display: inline-block;
    }
    .remove-btn:hover {
        color: #333;
    }

</style>

<div class="container cart-page-container">
    @if (session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #f5c6cb;">
            <strong>Error!</strong> {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #f5c6cb;">
            <strong>Periksa Input Anda:</strong>
            <ul style="margin-top: 5px; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="cart-grid">

        <div class="cart-items-section">
            <h1>Shopping Cart</h1>

            @forelse ($cartItems as $id => $item)
                <div class="cart-item">
                    <img src="{{ asset('storage/' . $item['image_path']) }}" alt="{{ $item['name'] }}">
                    <div class="cart-item-info">
                        <h3>{{ $item['name'] }}</h3>
                        <div class="quantity-selector">
                            <form action="{{ route('cart.update') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                <button type="submit" class="quantity-btn" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>-</button>
                            </form>

                            <span style="padding: 0 8px; font-weight: bold; min-width: 20px; text-align: center;">
                                {{ $item['quantity'] }}
                            </span>

                            <form action="{{ route('cart.update') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                <button type="submit" class="quantity-btn">+</button>
                            </form>
                        </div>

                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $id }}">
                            <button type="submit" class="remove-btn">Remove</button>
                        </form>
                    </div>
                    <span class="price">Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                </div>
            @empty
                <p>Keranjang belanja Anda masih kosong.</p>
            @endforelse

            <div class="cart-total">
                <span>Total</span>
                <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
            </div>

            </div>


        <form class="checkout-section" action="{{ route('checkout.store') }}" method="POST">
            @csrf <h2>Checkout</h2>

            <h3>Delivery</h3>
            <p>Select how you would like to receive your order:</p>

            <div class="delivery-options">
                <div class="delivery-choice active" id="btn-deliver">
                    <span>Deliver to address</span>
                </div>
                <div class="delivery-choice" id="btn-pickup">
                    <span>I'll pick up</span>
                </div>
            </div>

            <input type="hidden" name="delivery_type" id="delivery_type" value="deliver">

            <div id="contact-info">
                <p>Enter your information:</p>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="customer_name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="customer_phone" placeholder="Enter your phone" required>
                </div>
            </div>

            <div id="address-info" style="display: block;">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="customer_address" placeholder="Enter your address">
                </div>
            </div>

            <button type="submit" class="checkout-btn">Checkout</button>

        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
            const deliverButton = document.getElementById('btn-deliver');
            const pickupButton = document.getElementById('btn-pickup');
            const addressSection = document.getElementById('address-info');
            const deliveryTypeInput = document.getElementById('delivery_type');
            const addressInput = document.getElementById('address');
            deliverButton.addEventListener('click', function() {
                addressSection.style.display = 'block';
                deliverButton.classList.add('active');
                pickupButton.classList.remove('active');
                deliveryTypeInput.value = 'deliver';
                addressInput.required = true;
            });

            pickupButton.addEventListener('click', function() {
                addressSection.style.display = 'none';
                pickupButton.classList.add('active');
                deliverButton.classList.remove('active');
                deliveryTypeInput.value = 'pickup';
                addressInput.required = false;
            });
        });
</script>
@endsection
