<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $request->validate([
            'payment_method' => 'required',
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $carts = Cart::where('user_id', Auth::id())->with('product.shop')->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Keranjang kamu kosong.');
        }

        try {
            $paymentProof = $request->file('payment_proof')->store('payment_proofs', 'public');

            // Hitung total
            $total = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

            // Buat order (STATUS PENDING)
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',  // tidak langsung paid
                'status' => 'pending',
                'vendor_status' => 'pending',
                'payment_proof' => $paymentProof,
            ]);

            // Create order items (stok belum dikurangi!)
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                    'subtotal' => $cart->product->price * $cart->quantity,
                ]);
            }

            Cart::where('user_id', Auth::id())->delete();

            return redirect()->route('user.orders.history')->with('success', 'Pesanan dibuat, menunggu verifikasi vendor.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->with('orderItems.product')->get();
        return view('user.orders.history', compact('orders'));
    }
}