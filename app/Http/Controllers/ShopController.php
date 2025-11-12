<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VendorRequest;

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

        if ($request->status === 'approved') {
            $shop->user->update(['role' => 'vendor']);

            // Logout user yang diupdate agar login ulang dengan role baru
            if (auth()->id() === $shop->user->id) {
                auth()->logout();
                return redirect()->route('login')->with('info', 'Role Anda telah berubah, silakan login kembali.');
            }
        }

        return back()->with('success', 'Status toko berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $shop = Shop::findOrFail($id);

        // Hanya admin atau pemilik toko yang boleh hapus
        if (Auth::user()->role !== 'admin' && $shop->user_id !== Auth::id()) {
            abort(403, 'Tidak diizinkan menghapus toko ini.');
        }

        $shop->delete();

        return back()->with('success', 'Toko berhasil dihapus.');
    }
}
