<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class VendorReportController extends Controller
{
    public function index()
    {
        $reports = Report::with('shop')
            ->where('user_id', Auth::id())
            ->orderBy('report_month', 'desc')
            ->get();

        return view('toko.reports.index', compact('reports'));
    }

    public function destroy($id)
    {
        $report = Report::where('user_id', Auth::id())->findOrFail($id);
        $report->delete();

        return back()->with('success', 'Laporan berhasil dihapus.');
    }
}
