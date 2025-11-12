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
                {{-- Wrapper responsif untuk tabel --}}
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
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="gambar"
                                                class="rounded img-fluid" style="max-width: 60px;">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->shop->name ?? 'Tidak ada toko' }}</td>
                                    <td class="text-wrap">{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? '-' }}</td>
                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->created_at->format('d M Y') }}</td>
                                    <td>
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

    {{-- Sedikit padding untuk layar kecil --}}
    <style>
        @media (max-width: 576px) {
            h2 {
                font-size: 1.25rem;
            }

            .table thead {
                display: none;
            }

            .table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #dee2e6;
                border-radius: .5rem;
                padding: .75rem;
            }

            .table tbody td {
                display: flex;
                justify-content: space-between;
                padding: .5rem 0;
                border: none;
            }

            .table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #495057;
            }
        }
    </style>
@endsection