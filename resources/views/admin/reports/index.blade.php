@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Laporan Penjualan</h2>
        <form action="{{ route('admin.reports.generate') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">
                🔄 Generate Laporan Bulan Ini
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($reports->isEmpty())
        <div class="alert alert-info">Belum ada laporan penjualan yang tersedia.</div>
    @else
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Vendor</th>
                                <th>Bulan Laporan</th>
                                <th>Total Penjualan (Rp)</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $index => $report)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $report->user->name ?? 'Admin' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($report->report_month . '-01')->translatedFormat('F Y') }}</td>
                                    <td>Rp {{ number_format($report->total_sales, 0, ',', '.') }}</td>
                                    <td>{{ $report->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection