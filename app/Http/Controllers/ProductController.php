<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $shops = Shop::where('user_id', Auth::id())->where('status', 'approved')->get();
        return view('admin.products.create', compact('categories', 'shops'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shop_id' => 'required',
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('products', 'public') : null;

        Product::create([
            'shop_id' => $request->shop_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus gambar jika ada
        if ($product->image && file_exists(storage_path('app/public/' . $product->image))) {
            unlink(storage_path('app/public/' . $product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function userIndex()
    {
        $products = Product::with('category', 'shop')->latest()->paginate(12);
        return view('user.products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('category', 'shop')->findOrFail($id);
        return view('user.products.show', compact('product'));
    }
}
