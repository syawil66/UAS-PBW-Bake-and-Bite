<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index()
    {
        // Ambil data keranjang dari session
        $cartItems = session()->get('cart', []);

        // Hitung total harga
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    /**
     * Menambahkan produk ke keranjang.
     */
    public function add(Request $request)
    {
        // 1. Validasi request (pastikan product_id ada)
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $productId = $request->product_id;
        $product = Product::findOrFail($productId);

        // 2. Ambil keranjang yang ada dari session, atau buat array kosong
        $cart = session()->get('cart', []);

        // 3. Cek apakah produk sudah ada di keranjang
        if(isset($cart[$productId])) {
            // Jika sudah ada, tambahkan quantity-nya
            $cart[$productId]['quantity']++;
        } else {
            // Jika belum ada, tambahkan sebagai item baru
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image_path" => $product->image_path,
            ];
        }

        // 4. Simpan kembali array $cart ke dalam session
        session()->put('cart', $cart);

        // 5. Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Kita akan tambahkan fungsi update() dan remove() nanti
}
