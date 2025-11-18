@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <div class="container py-4">

        {{-- Title --}}
        <h2 class="mb-4 text-center text-md-start fw-bold">🛒 Daftar Produk</h2>

        {{-- Filter Category --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form action="{{ route('user.products.index') }}" method="GET">
                    <div class="row justify-content-center">
                        <div class="">
                            <label class="form-label fw-semibold">Filter Kategori</label>
                            <select name="category" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Jika tidak ada produk --}}
        @if($products->isEmpty())
            <div class="text-center py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="No Products" width="120"
                    class="mb-3 opacity-75">
                <h5 class="text-muted">Produk belum tersedia</h5>
                <p class="text-secondary small">Silakan cek kembali nanti, ya!</p>
            </div>
        @else

            {{-- Grid Produk --}}
            <div class="row g-3 g-md-4">
                @foreach($products as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm border-0 product-card">

                            {{-- Product Image --}}
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}"
                                    style="height: 200px; object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top" alt="no image">
                            @endif

                            {{-- Product Info --}}
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title mb-1 text-truncate fw-semibold">
                                    {{ $product->name }}
                                </h6>

                                <p class="text-muted small mb-2">
                                    {{ $product->category->name ?? 'Tanpa Kategori' }}
                                </p>

                                <p class="fw-bold text-success mb-3">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </p>

                                <a href="{{ route('user.products.show', $product->id) }}"
                                    class="btn btn-sm btn-primary mt-auto w-100">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>

        @endif
    </div>

    {{-- Styling tambahan --}}
    <style>
        .product-card {
            transition: 0.25s ease-in-out;
            border-radius: 10px;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
        }
    </style>
@endsection