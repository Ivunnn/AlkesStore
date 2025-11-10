@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<h2 class="mb-4">Daftar Produk</h2>

<div class="row">
    @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height:200px; object-fit:cover;">
                @else
                    <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top" alt="no image">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="text-muted mb-1">{{ $product->category->name ?? 'Tanpa Kategori' }}</p>
                    <p class="fw-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    <a href="{{ route('user.products.show', $product->id) }}" class="btn btn-sm btn-primary w-100">Lihat Detail</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $products->links() }}
</div>
@endsection
