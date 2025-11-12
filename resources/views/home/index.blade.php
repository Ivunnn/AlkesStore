@extends('layouts.app')

@section('title', 'Beranda - Toko Alat Kesehatan')

@section('content')
    <div class="container py-4">

        {{-- Banner / Hero Section --}}
        <div class="bg-light rounded-3 p-4 p-md-5 mb-5 text-center shadow-sm">
            <h1 class="fw-bold mb-3 display-6 display-md-5">
                Selamat Datang di <span class="text-primary">AlkesStore</span>
            </h1>
            <p class="lead text-muted mb-4">
                Temukan alat kesehatan berkualitas dengan harga terjangkau, siap dikirim ke seluruh Indonesia.
            </p>
            <a href="{{ route('user.products.index') }}" class="btn btn-primary btn-lg">
                <i class="fa-solid fa-store me-2"></i> Lihat Produk
            </a>
        </div>

        {{-- Kategori Section --}}
        @if(isset($categories) && $categories->count() > 0)
            <h3 class="fw-bold mb-3 text-center text-md-start">Kategori Produk</h3>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">
                @foreach($categories as $category)
                    <div class="col">
                        <a href="{{ route('products.byCategory', $category->id) }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm text-center h-100 hover-scale">
                                <div class="card-body d-flex flex-column justify-content-center">
                                    <h5 class="card-title text-success mb-2">{{ $category->name }}</h5>
                                    <p class="text-muted small mb-0">{{ $category->products->count() }} Produk</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Produk Terbaru --}}
        <h3 class="fw-bold mb-4 text-center text-md-start">Produk Terbaru</h3>
        @if ($products->count() > 0)
            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}"
                                class="card-img-top" alt="{{ $product->name }}"
                                style="height: 200px; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">

                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title fw-semibold">{{ $product->name }}</h6>
                                <p class="text-muted small mb-3">{{ Str::limit($product->description, 60) }}</p>
                                <div class="mt-auto">
                                    <p class="fw-bold text-success mb-2">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('user.products.show', $product->id) }}"
                                            class="btn btn-outline-primary btn-sm w-100">
                                            <i class="fa-solid fa-info-circle me-1"></i> Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        @else
            <div class="alert alert-info text-center mt-3">Belum ada produk yang tersedia.</div>
        @endif

    </div>

    {{-- Style tambahan untuk efek interaktif --}}
    <style>
        /* Hover efek untuk kategori */
        .hover-scale:hover {
            transform: scale(1.03);
            transition: transform 0.2s ease-in-out;
        }

        /* Responsive heading */
        @media (max-width: 576px) {
            h1.display-6 {
                font-size: 1.75rem;
            }
        }

        /* Kartu produk mobile-friendly */
        .card img {
            height: 180px;
        }
    </style>
@endsection