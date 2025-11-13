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
                                {{-- ⭐ data-label ditambahkan --}}
                                <td class="text-center fw-semibold" data-label="#">{{ $index + 1 }}</td>

                                {{-- ⭐ data-label ditambahkan --}}
                                <td class="text-center" data-label="Gambar">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="img-thumbnail rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <span class="text-muted small fst-italic">Tidak ada gambar</span>
                                    @endif
                                </td>

                                {{-- ⭐ data-label ditambahkan --}}
                                <td class="fw-medium" data-label="Nama Produk">{{ $product->name }}</td>

                                {{-- ⭐ data-label ditambahkan --}}
                                <td class="text-success fw-semibold" data-label="Harga">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>

                                {{-- ⭐ data-label ditambahkan --}}
                                <td class="text-center" data-label="Stok">{{ $product->stock }}</td>

                                {{-- ⭐ data-label ditambahkan (style dan class dihapus agar rapi di mobile) --}}
                                <td data-label="Deskripsi">{{ $product->description ?? '-' }}</td>

                                {{-- ⭐ data-label ditambahkan --}}
                                <td class="text-center" data-label="Aksi">
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
        /* CSS untuk desktop agar 'Deskripsi' tidak terlalu panjang */
        @media (min-width: 769px) {
            td[data-label="Deskripsi"] {
                max-width: 250px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }

        /* CSS Responsif untuk Mobile (Penyempurnaan) */
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
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            }

            table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                /* Menjaga label dan nilai tetap sejajar */
                padding: 0.5rem 0;
                font-size: 0.9rem;
                border-bottom: 1px solid #f0f0f0;
                /* Pemisah antar field */
            }

            table tbody tr td:last-child {
                border-bottom: none;
                /* Hapus pemisah untuk field terakhir */
            }

            table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #495057;
                padding-right: 1rem;
                /* Jarak antara label dan nilai */
                text-align: left;
            }

            /* Paksa semua konten di kanan agar rata kanan */
            table tbody td>* {
                text-align: right;
            }

            /* Penyesuaian khusus untuk kolom 'text-center' */
            td.text-center {
                text-align: right !important;
            }

            /* Penyesuaian untuk kolom 'Deskripsi' agar bisa wrap */
            td[data-label="Deskripsi"] {
                white-space: normal;
                text-align: right;
            }

            /* Penyesuaian untuk kolom 'Aksi' agar tombol full-width */
            td[data-label="Aksi"] {
                display: block;
                /* Ubah dari flex ke block */
                padding-top: 0.75rem;
            }

            td[data-label="Aksi"] form,
            td[data-label="Aksi"] .btn {
                width: 100%;
                /* Buat tombol memenuhi 'card' */
            }
        }
    </style>
@endsection