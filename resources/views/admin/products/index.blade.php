@extends('layouts.admin')

@section('title', 'Manajemen Produk - Admin')

@section('content')
    <div class="container-fluid">
        <h2 class="fw-bold mb-4"><i class="bi bi-box-seam"></i> Manajemen Produk</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Produk
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                {{-- Wrapper responsif untuk tabel (berguna untuk tablet) --}}
                <div class="table-responsive">
                    <table class="table table-striped mb-0 align-middle">
                        <thead class="table-primary text-nowrap">
                            <tr>
                                <th>#</th>
                                <th>Gambar</th>
                                <th>Mitra</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    {{-- ⭐ Tambahkan data-label di sini --}}
                                    <td data-label="#">{{ $loop->iteration }}</td>
                                    
                                    {{-- ⭐ Tambahkan data-label di sini --}}
                                    <td data-label="Gambar">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="gambar"
                                                class="rounded img-fluid" style="max-width: 60px;">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                    
                                    {{-- ⭐ Tambahkan data-label di sini --}}
                                    <td data-label="Mitra">{{ $product->shop->name ?? 'Tidak ada toko' }}</td>
                                    
                                    {{-- ⭐ Tambahkan data-label di sini --}}
                                    <td data-label="Nama Produk" class="text-wrap">{{ $product->name }}</td>
                                    
                                    {{-- ⭐ Tambahkan data-label di sini --}}
                                    <td data-label="Kategori">{{ $product->category->name ?? '-' }}</td>
                                    
                                    {{-- ⭐ Tambahkan data-label di sini --}}
                                    <td data-label="Harga">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    
                                    {{-- ⭐ Tambahkan data-label di sini --}}
                                    <td data-label="Stok">{{ $product->stock }}</td>
                                    
                                    {{-- ⭐ Tambahkan data-label di sini --}}
                                    <td data-label="Dibuat">{{ $product->created_at->format('d M Y') }}</td>
                                    
                                    {{-- ⭐ Tambahkan data-label di sini --}}
                                    <td data-label="Aksi">
                                        <div class="d-flex flex-column flex-md-row gap-2">
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger w-100">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4 text-muted">
                                        Belum ada produk ditambahkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>

    {{-- CSS Anda sudah benar, ini akan berfungsi setelah data-label ditambahkan --}}
    <style>
        @media (max-width: 576px) {
            h2 {
                /* Sedikit lebih besar agar tetap terbaca */
                font-size: 1.5rem; 
            }

            .table thead {
                display: none;
            }

            .table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #dee2e6;
                border-radius: .5rem;
                /* Padding di sini agar ada ruang di dalam "card" */
                padding: .75rem; 
                box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            }

            .table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center; /* Menyelaraskan label dan nilai */
                padding: .5rem 0.25rem; /* Sedikit padding horizontal */
                border: none;
                border-bottom: 1px solid #f0f0f0; /* Garis pemisah antar field */
            }
            
            /* Hapus border untuk item terakhir */
            .table tbody tr td:last-child {
                border-bottom: none;
            }

            .table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #495057;
                padding-right: 1rem; /* Jarak antara label dan nilai */
                text-align: left;
            }
            
            /* Pastikan konten di sisi kanan (gambar, tombol, teks) tidak terlalu lebar */
            .table tbody td > * {
                text-align: right;
                max-width: 60%; /* Batasi lebar konten */
            }
            
            /* Khusus untuk tombol agar full width di dalam "card" */
            .table tbody td[data-label="Aksi"] {
                display: block; /* Ubah flex menjadi block untuk tombol */
                padding-top: 0.75rem;
            }
            .table tbody td[data-label="Aksi"] .d-flex {
                 width: 100%;
            }
        }
    </style>
@endsection