<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Order;

class VendorDashboardController extends Controller
{
    public function index()
    {
        $shop = Shop::where('user_id', Auth::id())->first();
        $productCount = $shop ? $shop->products()->count() : 0;
        $totalOrders = $shop ? Order::whereHas('orderItems.product', fn($q) => $q->where('shop_id', $shop->id))->count() : 0;

        return view('toko.dashboard', compact('shop', 'productCount', 'totalOrders'));
    }
}
