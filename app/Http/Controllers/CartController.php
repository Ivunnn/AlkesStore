<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('user.cart.index', compact('carts'));
    }

    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // 🛑 Cek stok produk
        if ($product->stock <= 0) {
            return back()->with('error', 'Stok produk habis!');
        }

        DB::transaction(function () use ($product, $productId) {
            // Kurangi stok produk
            $product->decrement('stock', 1);

            // Tambahkan ke keranjang (atau update quantity jika sudah ada)
            $cart = Cart::where('user_id', Auth::id())
                        ->where('product_id', $productId)
                        ->first();

            if ($cart) {
                $cart->increment('quantity', 1);
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'quantity' => 1,
                ]);
            }
        });

        return back()->with('success', 'Produk ditambahkan ke keranjang dan stok berkurang.');
    }

    public function destroy($id)
    {
        $cart = Cart::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->with('product')
                    ->firstOrFail();

        // Tambahkan kembali stok produk saat dihapus dari keranjang
        if ($cart->product) {
            $cart->product->increment('stock', $cart->quantity);
        }

        $cart->delete();

        return back()->with('success', 'Produk dihapus dari keranjang dan stok dikembalikan.');
    }
}
