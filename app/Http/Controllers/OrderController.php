<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Tambahkan DB Facade untuk Transaction
use Illuminate\Http\Request;
use App\Mail\OrderCreatedMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function checkout()
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('user.orders.checkout', compact('carts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|max:20',
            'recipient_address' => 'required|string',
        ]);

        // Gunakan DB Transaction untuk keamanan data (jika error, semua dibatalkan)
        return DB::transaction(function () use ($request) {
            try {
                $carts = Cart::where('user_id', Auth::id())->with('product')->get();

                if ($carts->isEmpty()) {
                    return back()->with('error', 'Keranjang kamu kosong.');
                }

                // Cek stok sebelum proses
                foreach ($carts as $cart) {
                    if ($cart->product->stock < $cart->quantity) {
                        throw new \Exception("Stok produk {$cart->product->name} tidak mencukupi.");
                    }
                }

                $paymentProof = $request->file('payment_proof')->store('payment_proofs', 'public');
                $total = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

                // 1. Buat Order
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total_price' => $total,
                    'payment_method' => $request->payment_method,
                    'payment_status' => 'pending',
                    'status' => 'pending',
                    'vendor_status' => 'pending',
                    'payment_proof' => $paymentProof,
                    'recipient_name' => $request->recipient_name,
                    'recipient_phone' => $request->recipient_phone,
                    'recipient_address' => $request->recipient_address,
                ]);

                // 2. Buat Item Order & Kurangi Stok
                foreach ($carts as $cart) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cart->product_id,
                        'quantity' => $cart->quantity,
                        'price' => $cart->product->price,
                        'subtotal' => $cart->product->price * $cart->quantity,
                    ]);

                    // OPTIMASI: Kurangi stok produk
                    $cart->product->decrement('stock', $cart->quantity);
                }

                // 3. Hapus Keranjang
                Cart::where('user_id', Auth::id())->delete();

                // 4. Kirim Email (Opsional: bungkus try-catch agar jika email gagal, order tetap masuk)
                try {
                    Mail::to(Auth::user()->email)->send(new OrderCreatedMail($order));
                } catch (\Exception $e) {
                    // Log error email jika perlu, tapi jangan batalkan order
                }

                return redirect()->route('user.orders.history')
                    ->with('success', 'Pesanan dibuat, menunggu verifikasi vendor.');

            } catch (\Exception $e) {
                // Rollback otomatis terjadi jika ada error di dalam transaction block
                return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        });
    }

    public function history()
    {
        // Menggunakan latest() agar pesanan terbaru muncul di atas
        $orders = Order::where('user_id', Auth::id())
            ->with('orderItems.product')
            ->latest()
            ->get();

        return view('user.orders.history', compact('orders'));
    }
}