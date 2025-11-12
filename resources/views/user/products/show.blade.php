@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="container py-4">
        <div class="row g-4 align-items-center">
            {{-- Gambar Produk --}}
            <div class="col-md-5 text-center">
                <div class="position-relative">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="img-fluid rounded-4 shadow-lg hover-zoom">
                    @else
                        <img src="https://via.placeholder.com/400x400?text=No+Image" alt="no image"
                            class="img-fluid rounded-4 shadow-lg hover-zoom">
                    @endif
                </div>
            </div>

            {{-- Informasi Produk --}}
            <div class="col-md-7">
                <h2 class="fw-bold mb-1">{{ $product->name }}</h2>
                <p class="text-muted mb-2">
                    <i class="bi bi-tag"></i> {{ $product->category->name ?? 'Tanpa Kategori' }}
                </p>
                <h3 class="text-success fw-semibold mb-4">
                    Rp{{ number_format($product->price, 0, ',', '.') }}
                </h3>

                <p class="lead">{{ $product->description ?? 'Tidak ada deskripsi.' }}</p>

                <div class="d-flex flex-wrap gap-3 mt-3">
                    <div class="badge bg-light text-dark p-2 px-3 border shadow-sm">
                        <i class="bi bi-box-seam"></i> Stok: <strong>{{ $product->stock }}</strong>
                    </div>
                    <div class="badge bg-light text-dark p-2 px-3 border shadow-sm">
                        <i class="bi bi-shop"></i> Mitra: <strong>{{ $product->shop->name ?? '-' }}</strong>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-4 d-flex flex-wrap gap-3">
                    @auth
                        <form action="{{ route('user.cart.store', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm px-4">
                                <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg px-4">
                            <i class="bi bi-box-arrow-in-right"></i> Login untuk Membeli
                        </a>
                    @endauth

                    <a href="{{ route('user.products.index') }}" class="btn btn-secondary btn-lg px-4">
                        ← Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Sedikit CSS tambahan agar lebih hidup --}}
    <style>
        .hover-zoom {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-zoom:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection