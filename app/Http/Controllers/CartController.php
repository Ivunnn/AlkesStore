<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Tetap import DB, mungkin berguna nanti

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
        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        // Tentukan jumlah yang ingin ditambahkan (misal 1, atau dari request)
        $quantityToAdd = 1; // Asumsi user mengklik tombol "tambah" 1x

        $currentInCart = $cart ? $cart->quantity : 0;
        $newQuantity = $currentInCart + $quantityToAdd;

        // 🛑 Cek stok produk
        // Kita cek apakah stok yang ADA LEBIH KECIL dari yang DIINGINKAN
        if ($product->stock < $newQuantity) {
            return back()->with('error', 'Stok produk tidak mencukupi (tersisa ' . $product->stock . ').');
        }

        // TIDAK ADA PENGURANGAN STOK DI SINI
        // DB::transaction(function () ... Dihapus

        // Tambahkan ke keranjang (atau update quantity jika sudah ada)
        if ($cart) {
            // Jika sudah ada, update quantity-nya
            $cart->increment('quantity', $quantityToAdd);
        } else {
            // Jika belum ada, buat entri baru
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $newQuantity, // Langsung gunakan quantity baru
            ]);
        }

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function destroy($id)
    {
        $cart = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail(); // Tidak perlu ->with('product')

        // TIDAK ADA PENGEMBALIAN STOK DI SINI
        // if ($cart->product) { ... } Dihapus

        $cart->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}