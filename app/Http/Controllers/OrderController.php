<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('orders.checkout', compact('carts'));
    }

    public function store(Request $request)
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        $total = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'payment_method' => $request->payment_method,
            'payment_status' => 'paid',
            'status' => 'paid',
        ]);

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

        return redirect()->route('orders.history')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->with('orderItems.product')->get();
        return view('orders.history', compact('orders'));
    }
}
