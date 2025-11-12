@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="row">
        <div class="col-md-5">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow">
            @else
                <img src="https://via.placeholder.com/400x400?text=No+Image" class="img-fluid rounded shadow">
            @endif
        </div>

        <div class="col-md-7">
            <h2>{{ $product->name }}</h2>
            <p class="text-muted">{{ $product->category->name ?? 'Tanpa Kategori' }}</p>
            <h4 class="text-success">Rp{{ number_format($product->price, 0, ',', '.') }}</h4>

            <p class="mt-3">{{ $product->description ?? 'Tidak ada deskripsi.' }}</p>

            <p><strong>Stok:</strong> {{ $product->stock }}</p>
            <p><strong>Mitra / Toko:</strong> {{ $product->shop->name ?? '-' }}</p>
            
            @auth
                <form action="{{ route('user.cart.store', $product->id) }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                    </button>
                </form>
            @else
                <p class="text-muted mt-3">
                    <a href="{{ route('login') }}">Login</a> untuk menambahkan ke keranjang.
                </p>
            @endauth

            <a href="{{ route('user.products.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
        </div>
    </div>
@endsection