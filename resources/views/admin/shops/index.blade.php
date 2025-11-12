@extends('layouts.admin')

@section('title', 'Daftar Toko Saya')

@section('content')
<div class="container-fluid px-3">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <div>
            <h2 class="fw-bold mb-2"><i class="bi bi-shop"></i> Daftar Mitra AlkesStore</h2>
            <p class="text-muted mb-0">Kelola semua toko mitra yang terdaftar dalam sistem.</p>
        </div>
        <a href="{{ route('admin.shops.create') }}" class="btn btn-primary mt-3 mt-md-0 shadow-sm">
            <i class="bi bi-plus-circle"></i> Daftarkan Mitra
        </a>
    </div>

    {{-- Alert Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Jika Belum Ada Data --}}
    @if($shops->isEmpty())
        <div class="alert alert-info text-center py-4 shadow-sm">
            <i class="bi bi-info-circle"></i> Belum ada mitra yang mengajukan.
        </div>
    @else
        {{-- Tabel Responsif --}}
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 20%">Nama Toko</th>
                                <th style="width: 35%">Deskripsi</th>
                                <th style="width: 15%">Status</th>
                                <th style="width: 25%" class="text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shops as $index => $shop)
                                <tr>
                                    <td class="fw-semibold">{{ $index + 1 }}</td>
                                    <td class="fw-semibold text-primary">{{ $shop->name }}</td>
                                    <td>{{ $shop->description ?? '-' }}</td>
                                    <td>
                                        @if($shop->status == 'approved')
                                            <span class="badge bg-success px-3 py-2">Disetujui</span>
                                        @elseif($shop->status == 'pending')
                                            <span class="badge bg-warning text-dark px-3 py-2">Menunggu</span>
                                        @else
                                            <span class="badge bg-danger px-3 py-2">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-2">
                                            @if(Auth::user()->role === 'admin')
                                                <form action="{{ route('shops.updateStatus', $shop->id) }}" method="POST" class="d-flex flex-column flex-sm-row align-items-center gap-2">
                                                    @csrf
                                                    <select name="status" class="form-select form-select-sm w-auto">
                                                        <option value="pending" {{ $shop->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="approved" {{ $shop->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                                        <option value="rejected" {{ $shop->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                    </select>
                                                    <button class="btn btn-sm btn-success">
                                                        <i class="bi bi-check-lg"></i> Update
                                                    </button>
                                                </form>
                                            @endif

                                            <form action="{{ route('admin.shops.destroy', $shop->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus toko ini?')" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- Styling tambahan untuk tampilan lebih elegan --}}
<style>
    .table thead th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 0.3px;
    }

    .table tbody tr:hover {
        background-color: #f9fbff;
        transition: background 0.2s ease;
    }

    @media (max-width: 768px) {
        .table thead {
            display: none;
        }
        .table tbody tr {
            display: block;
            margin-bottom: 15px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.08);
            padding: 10px;
        }
        .table tbody td {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            border: none;
        }
        .table tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #333;
        }
    }
</style>
@endsection
