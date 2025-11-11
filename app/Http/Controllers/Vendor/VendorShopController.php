<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorShopController extends Controller
{
    public function index()
    {
        $shop = Shop::where('user_id', Auth::id())->first();
        return view('toko.shops.index', compact('shop'));
    }

    public function create()
    {
        return view('toko.shops.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable|string',
        ]);

        Shop::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => $request->name,
                'description' => $request->description,
                'status' => 'active',
            ]
        );

        return redirect()->route('vendor.shops.index')->with('success', 'Toko berhasil dibuat atau diperbarui.');
    }
}
