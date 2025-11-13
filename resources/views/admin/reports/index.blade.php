@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
    <div class="container-fluid px-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <h2 class="fw-bold mb-0 text-black">📊 Laporan Penjualan</h2>

            <form action="{{ route('admin.reports.generate') }}" method="POST" class="d-flex justify-content-end">
                @csrf
                <button type="submit" class="btn btn-primary shadow-sm d-flex align-items-center">
                    🔄 <span class="ms-2">Generate Laporan Bulan Ini</span>
                </button>
            </form>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($reports->isEmpty())
            <div class="alert alert-info text-center py-4 shadow-sm">
                <strong>ℹ️ Belum ada laporan penjualan yang tersedia.</strong>
            </div>
        @else
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-primary">
                                <tr class="text-center">
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
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $report->user->name ?? 'Admin' }}</td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($report->report_month . '-01')->translatedFormat('F Y') }}
                                        </td>
                                        <td class="text-end text-success fw-semibold">
                                            Rp {{ number_format($report->total_sales, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            {{ $report->created_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus laporan ini?')" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-end mt-3">
                        {{ $reports->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection