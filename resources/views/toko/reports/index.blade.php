@extends('layouts.vendor')

@section('title', 'Laporan Penjualan')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center text-md-start">
            📊 Laporan Penjualan
        </h2>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Notifikasi error --}}
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($reports->isEmpty())
            <div class="alert alert-info text-center">
                Belum ada laporan penjualan.
            </div>
        @else
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-bordered table-striped align-middle mb-0">
                    <thead class="table-primary text-center">
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
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $report->report_month }}</td>
                                <td>Rp {{ number_format($report->total_sales, 0, ',', '.') }}</td>
                                <td>{{ $report->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('vendor.reports.destroy', $report->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus laporan ini?')" class="d-inline">
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
            </div>
        @endif
    </div>

    {{-- Tambahan style agar tabel tetap nyaman dibaca di HP --}}
    <style>
        @media (max-width: 768px) {
            h2 {
                font-size: 1.4rem;
            }

            .table th,
            .table td {
                font-size: 0.85rem;
                padding: 0.5rem;
            }

            .btn-sm {
                font-size: 0.8rem;
                padding: 0.3rem 0.6rem;
            }
        }
    </style>
@endsection