<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Report;
use Carbon\Carbon;

class VendorOrderController extends Controller
{
    public function index()
    {
        $orders = Order::whereHas('orderItems.product.shop', function ($q) {
            $q->where('user_id', auth()->id());
        })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('toko.orders.index', compact('orders'));
    }


    public function approve($id)
    {
        $order = Order::findOrFail($id);

        // 1. Kurangi stok
        foreach ($order->orderItems as $item) {
            $item->product->decrement('stock', $item->quantity);
        }

        // 2. Tambah ke laporan penjualan
        foreach ($order->orderItems as $item) {
            $vendorId = $item->product->shop->user_id;
            $shopId = $item->product->shop_id;
            $sales = $item->subtotal;

            $month = Carbon::now()->format('Y-m');

            $report = Report::firstOrCreate(
                [
                    'user_id' => $vendorId,
                    'shop_id' => $shopId,
                    'report_month' => $month,
                ],
                ['total_sales' => 0]
            );

            $report->increment('total_sales', $sales);
        }

        // 3. Update status order
        $order->update([
            'payment_status' => 'paid',
            'status' => 'paid',
            'vendor_status' => 'approved'
        ]);

        return back()->with('success', 'Pesanan disetujui.');
    }

    public function reject($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'payment_status' => 'failed',
            'status' => 'cancelled',
            'vendor_status' => 'rejected'
        ]);

        return back()->with('success', 'Pesanan ditolak.');
    }
}
