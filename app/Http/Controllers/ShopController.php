<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::where('user_id', Auth::id())->get();
        return view('admin.shops.index', compact('shops'));
    }

    public function create()
    {
        return view('admin.shops.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        Shop::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.shops.index')->with('success', 'Toko berhasil diajukan, menunggu persetujuan admin.');
    }

    public function updateStatus(Request $request, $id)
    {
        $shop = Shop::findOrFail($id);
        $shop->update(['status' => $request->status]);

        return back()->with('success', 'Status toko berhasil diperbarui.');
    }
}
