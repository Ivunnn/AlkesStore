@extends('layouts.vendor')

@section('title', 'Produk Saya')

@section('content')
    <div class="container-fluid py-4">

        {{-- Header --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <h2 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                <i class="bi bi-box-seam"></i> Produk Saya
            </h2>
            <a href="{{ route('vendor.products.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle"></i> Tambah Produk
            </a>
        </div>

        {{-- Alert Messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Jika Tidak Ada Produk --}}
        @if ($products->isEmpty())
            <div class="alert alert-info text-center shadow-sm rounded-3 py-4">
                <i class="bi bi-info-circle display-6 d-block mb-2"></i>
                <p class="mb-0 fw-semibold">Belum ada produk yang ditambahkan.</p>
            </div>
        @else
            {{-- Tabel Produk --}}
            <div class="table-responsive shadow-sm rounded-3">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>#</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $product)
                            <tr>
                                <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                                <td class="text-center">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="img-thumbnail rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <span class="text-muted small fst-italic">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td class="fw-medium">{{ $product->name }}</td>
                                <td class="text-success fw-semibold">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>
                                <td class="text-center">{{ $product->stock }}</td>
                                <td class="text-truncate" style="max-width: 250px;">{{ $product->description ?? '-' }}</td>
                                <td class="text-center">
                                    <form action="{{ route('vendor.products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
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

    {{-- CSS tambahan untuk efek interaktif dan responsif --}}
    <style>
        @media (max-width: 768px) {
            h2 {
                font-size: 1.5rem;
            }

            table thead {
                display: none;
            }

            table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #dee2e6;
                border-radius: 0.75rem;
                padding: 0.75rem;
                background-color: #fff;
            }

            table tbody td {
                display: flex;
                justify-content: space-between;
                padding: 0.5rem 0;
                font-size: 0.9rem;
            }

            table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #495057;
            }

            td.text-center {
                text-align: right !important;
            }
        }
    </style>
@endsection