<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class VendorProductController extends Controller
{
    public function index()
    {
        // Ambil toko milik vendor yang sedang login
        $shop = Shop::where('user_id', Auth::id())->first();

        // Jika belum punya toko, arahkan untuk membuatnya
        if (!$shop) {
            return redirect()->route('vendor.shops.index')
                ->with('error', 'Anda belum memiliki toko. Buat toko terlebih dahulu.');
        }

        // Ambil semua produk dari toko tersebut
        $products = Product::where('shop_id', $shop->id)->get();

        return view('toko.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('toko.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $shop = Shop::where('user_id', Auth::id())->first();

        if (!$shop) {
            return back()->with('error', 'Anda belum memiliki toko.');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'shop_id' => $shop->id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('vendor.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $shop = Shop::where('user_id', Auth::id())->first();
        $product = Product::where('shop_id', $shop->id)->findOrFail($id);
        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }
}
