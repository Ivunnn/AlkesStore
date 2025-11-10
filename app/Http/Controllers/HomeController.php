<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman utama toko
     */
    public function index()
    {
        // Ambil produk terbaru (misalnya 8 produk)
        $products = Product::latest()->paginate(8);

        // Kirim data ke view home/index.blade.php
        return view('home.index', compact('products'));
    }
}
