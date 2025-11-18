<?php

namespace App\Http\Controllers; // Pastikan namespace sesuai struktur folder Anda

use App\Models\Product;
use App\Models\Category;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Import Storage untuk hapus gambar

class ProductController extends Controller
{
    public function index()
    {
        // Menggunakan with() agar query lebih ringan (Eager Loading)
        $products = Product::with(['shop', 'category'])->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        // 🔴 PERBAIKAN DI SINI:
        // Ambil semua toko milik user dengan role 'vendor'
        $shops = Shop::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 'vendor');
            })
            ->where('status', 'approved')
            ->get();

        return view('admin.products.create', compact('categories', 'shops'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shop_id' => 'required|exists:shops,id', // Validasi pastikan toko ada
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

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

        // Hapus gambar jika ada (Menggunakan Storage Facade lebih aman)
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    // --- FITUR USER (Frontend) ---

    public function userIndex(Request $request)
    {
        $query = Product::with('category', 'shop')->where('stock', '>', 0)->latest(); // Tampilkan yg ada stok saja

        // Filter Kategori
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter Pencarian (Opsional)
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('user.products.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with('category', 'shop')->findOrFail($id);
        return view('user.products.show', compact('product'));
    }
}