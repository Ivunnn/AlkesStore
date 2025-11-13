<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product; // Tambahkan import Product
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Tambahkan import DB
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function checkout()
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('user.orders.checkout', compact('carts'));
    }

    public function store(Request $request)
    {
        $carts = Cart::where('user_id', Auth::id())->with('product.shop')->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Keranjang kamu kosong.');
        }

        try {
            // Mulai transaksi database
            // Jika ada error di dalam blok ini, semua perubahan database akan dibatalkan
            $order = DB::transaction(function () use ($carts, $request) {

                // 1. Validasi stok SEKALI LAGI sebelum checkout
                foreach ($carts as $cart) {
                    // Kunci produk untuk update, mencegah race condition
                    $product = Product::lockForUpdate()->find($cart->product_id);

                    if ($product->stock < $cart->quantity) {
                        // Lempar Exception untuk membatalkan transaksi
                        throw new \Exception("Stok untuk produk '{$product->name}' tidak mencukupi. Stok tersisa: {$product->stock}.");
                    }
                }

                // 2. Buat Order
                $total = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total_price' => $total,
                    'payment_method' => $request->payment_method,
                    'payment_status' => 'paid',
                    'status' => 'paid',
                ]);

                // 3. Buat OrderItems, KURANGI STOK, dan buat Laporan
                foreach ($carts as $cart) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cart->product_id,
                        'quantity' => $cart->quantity,
                        'price' => $cart->product->price,
                        'subtotal' => $cart->product->price * $cart->quantity,
                    ]);

                    // === ❗️ STOK DIKURANGI DI SINI ===
                    // Kita gunakan $cart->product karena sudah di-load
                    $cart->product->decrement('stock', $cart->quantity);

                    // === Tambah laporan penjualan untuk vendor ===
                    $vendorId = $cart->product->shop->user_id ?? null;
                    $shopId = $cart->product->shop_id ?? null;

                    if ($vendorId && $shopId) {
                        $currentMonth = Carbon::now()->format('Y-m');
                        $report = Report::where('user_id', $vendorId)
                            ->where('shop_id', $shopId)
                            ->where('report_month', $currentMonth)
                            ->first();

                        $sales = $cart->product->price * $cart->quantity;

                        if ($report) {
                            $report->increment('total_sales', $sales);
                        } else {
                            Report::create([
                                'user_id' => $vendorId,
                                'shop_id' => $shopId,
                                'report_month' => $currentMonth,
                                'total_sales' => $sales,
                            ]);
                        }
                    }
                }

                // 4. Kosongkan keranjang (karena sudah masuk order)
                Cart::where('user_id', Auth::id())->delete();

                // Kembalikan order untuk dipakai di luar transaksi
                return $order;
            });

            // Jika transaksi berhasil
            return redirect()->route('user.orders.history')->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            // 5. Tangkap error (jika stok tidak cukup atau error lain)
            // Transaksi sudah otomatis di-rollback
            return back()->with('error', $e->getMessage());
        }
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->with('orderItems.product')->get();
        return view('user.orders.history', compact('orders'));
    }
}