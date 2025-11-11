@extends('layouts.vendor') 

@section('title', 'Laporan Penjualan')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📊 Laporan Penjualan</h2>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Notifikasi error --}}
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($reports->isEmpty())
        <div class="alert alert-info">Belum ada laporan penjualan.</div>
    @else
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Bulan Laporan</th>
                    <th>Total Penjualan</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $index => $report)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $report->report_month }}</td>
                        <td>Rp {{ number_format($report->total_sales, 0, ',', '.') }}</td>
                        <td>{{ $report->created_at->format('d M Y') }}</td>
                        <td>
                            <form action="{{ route('vendor.reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
