@extends('layouts.app')

@section('title', 'Beranda - Toko Alat Kesehatan')

@section('content')
    <div class="container py-4">

        {{-- Banner / Hero Section --}}
        <div class="bg-light rounded-3 p-5 mb-5 text-center shadow-sm">
            <h1 class="fw-bold mb-3">Selamat Datang di <span class="text-primary">AlkesStore</span></h1>
            <p class="lead text-muted">Tempat terbaik untuk menemukan alat kesehatan berkualitas dengan harga terjangkau.
            </p>
            <a href="{{ route('user.products.index') }}" class="btn btn-primary btn-lg mt-3">Lihat Produk</a>
        </div>

        {{-- Kategori Section --}}
        @if(isset($categories) && $categories->count() > 0)
            <h3 class="fw-bold mb-3">Kategori Produk</h3>
            <div class="row mb-5">
                @foreach($categories as $category)
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('products.byCategory', $category->id) }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm text-center h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-success">{{ $category->name }}</h5>
                                    <p class="text-muted small mb-0">{{ $category->products->count() }} Produk</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Produk Terbaru --}}
        <h3 class="fw-bold mb-4">Produk Terbaru</h3>

        @if ($products->count() > 0)
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}"
                                class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="text-muted small">{{ Str::limit($product->description, 60) }}</p>
                                <div class="mt-auto">
                                    <p class="fw-bold text-success mb-2">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('user.products.show', $product->id) }}"
                                            class="btn btn-outline-primary btn-sm">Detail</a>
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">+ Keranjang</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        @else
            <div class="alert alert-info text-center">Belum ada produk yang tersedia.</div>
        @endif

    </div>
@endsection