<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Proses dan simpan pesanan.
     */
    public function store(Request $request)
    {
        // 1. Validasi data form
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'delivery_type' => 'required|string|in:deliver,pickup',
            'customer_address' => 'required_if:delivery_type,deliver|nullable|string',
        ]);

        // 2. Ambil data keranjang dari session
        $cartItems = session('cart', []);

        // 3. Cek jika keranjang kosong
        if (count($cartItems) == 0) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong!');
        }

        // 4. Hitung ulang total harga (agar aman)
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // 5. Mulai Database Transaction
        // Ini memastikan jika ada 1 error, semua proses dibatalkan
        try {
            DB::beginTransaction();

            // 6. Buat Order (Pesanan Utama)
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'delivery_type' => $request->delivery_type,
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            // 7. Simpan setiap item di keranjang ke tabel 'order_items'
            foreach ($cartItems as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Kurangi stok produk di sini
                $product = Product::find($id);
                // Pastikan stok cukup (bisa ditambahkan validasi)
                $product->decrement('stock', $item['quantity']);
            }

            // 8. Jika semua berhasil, commit ke database
            DB::commit();

            // 9. Kosongkan keranjang belanja
            session()->forget('cart');

            // 10. Redirect ke halaman "Terima Kasih"
            return redirect()->route('checkout.success');

        } catch (\Exception $e) {
            // 11. Jika ada error, batalkan semua (rollback)
            DB::rollBack();
            // Tampilkan pesan error
            return redirect()->route('cart.index')->with('error', 'Terjadi kesalahan saat memproses pesanan Anda. Silakan coba lagi.');
        }
    }

    /**
     * Tampilkan halaman sukses.
     */
    public function success()
    {
        return view('checkout-success');
    }
}
