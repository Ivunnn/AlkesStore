<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        // Jika user adalah admin, tampilkan semua laporan
        if (Auth::user()->role === 'admin') {
            $reports = Report::with('user')->latest()->get();
        } else {
            // Jika vendor, tampilkan hanya laporan miliknya
            $reports = Report::where('user_id', Auth::id())->latest()->get();
        }

        return view('admin.reports.index', compact('reports'));
    }

    public function generate()
    {
        $month = now()->format('Y-m');

        // Total semua order (hanya untuk admin)
        $total = Order::whereMonth('created_at', now()->month)
            ->where('status', 'paid') // status disesuaikan
            ->sum('total_price');

        if (Auth::user()->role === 'admin') {
            // Admin mendapat laporan global
            Report::updateOrCreate(
                ['user_id' => Auth::id(), 'report_month' => $month],
                ['total_sales' => $total]
            );
        } else {
            // Vendor mendapat laporan berdasarkan toko-nya sendiri
            $vendorTotal = Order::whereHas('orderItems.product.shop', function ($q) {
                $q->where('user_id', Auth::id());
            })
                ->whereMonth('created_at', now()->month)
                ->where('status', 'paid')
                ->sum('total_price');

            Report::updateOrCreate(
                ['user_id' => Auth::id(), 'report_month' => $month],
                ['total_sales' => $vendorTotal]
            );
        }

        return back()->with('success', 'Laporan penjualan bulan ini berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $report = Report::findOrFail($id);

        // Admin bisa hapus semua laporan, vendor hanya laporan miliknya
        if (Auth::user()->role !== 'admin' && $report->user_id !== Auth::id()) {
            return back()->with('error', 'Kamu tidak memiliki izin untuk menghapus laporan ini.');
        }

        $report->delete();

        return back()->with('success', 'Laporan berhasil dihapus.');
    }
}
