<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::where('user_id', Auth::id())->get();
        return view('admin.reports.index', compact('reports'));
    }

    public function generate()
    {
        $month = now()->format('Y-m');
        $total = Order::whereMonth('created_at', now()->month)
            ->where('status', 'completed')
            ->sum('total_price');

        Report::updateOrCreate(
            ['user_id' => Auth::id(), 'report_month' => $month],
            ['total_sales' => $total]
        );

        return back()->with('success', 'Laporan penjualan bulan ini berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $report = Report::where('user_id', Auth::id())->findOrFail($id);
        $report->delete();

        return back()->with('success', 'Laporan berhasil dihapus.');
    }
}
