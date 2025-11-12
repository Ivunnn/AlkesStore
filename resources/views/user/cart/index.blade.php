@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center text-md-start">🛒 Keranjang Belanja</h2>

    {{-- Jika keranjang kosong --}}
    @if($carts->isEmpty())
        <div class="text-center py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/3081/3081840.png" alt="Empty Cart" width="120" class="mb-3 opacity-75">
            <h5 class="text-muted">Keranjang kamu masih kosong</h5>
            <p class="text-secondary small mb-3">Ayo mulai belanja produk favoritmu!</p>
            <a href="{{ route('user.products.index') }}" class="btn btn-primary">
                <i class="bi bi-bag"></i> Belanja Sekarang
            </a>
        </div>
    @else
        {{-- Desktop / Tablet View --}}
        <div class="table-responsive d-none d-md-block">
            <table class="table table-bordered align-middle shadow-sm">
                <thead class="table-primary">
                    <tr class="text-center">
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Kuantitas</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($carts as $cart)
                        @php 
                            $subtotal = $cart->product->price * $cart->quantity;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($cart->product->image)
                                        <img src="{{ asset('storage/'.$cart->product->image) }}" 
                                            alt="{{ $cart->product->name }}" 
                                            width="70" height="70" class="me-3 rounded">
                                    @else
                                        <img src="https://via.placeholder.com/70x70?text=No+Image" 
                                            alt="no image" class="me-3 rounded">
                                    @endif
                                    <div>
                                        <strong>{{ $cart->product->name }}</strong><br>
                                        <small class="text-muted">{{ $cart->product->category->name ?? 'Tanpa Kategori' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">Rp{{ number_format($cart->product->price, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $cart->quantity }}</td>
                            <td class="text-center fw-semibold text-success">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <form action="{{ route('user.cart.destroy', $cart->id) }}" method="POST" 
                                    onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Total:</td>
                        <td colspan="2" class="fw-bold text-success fs-5">Rp{{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Mobile View --}}
        <div class="d-md-none">
            @php $total = 0; @endphp
            @foreach($carts as $cart)
                @php 
                    $subtotal = $cart->product->price * $cart->quantity;
                    $total += $subtotal;
                @endphp
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex">
                            @if($cart->product->image)
                                <img src="{{ asset('storage/'.$cart->product->image) }}" 
                                    alt="{{ $cart->product->name }}" 
                                    width="80" height="80" class="rounded me-3">
                            @else
                                <img src="https://via.placeholder.com/80x80?text=No+Image" 
                                    alt="no image" class="rounded me-3">
                            @endif
                            <div class="flex-grow-1">
                                <h6 class="fw-semibold mb-1">{{ $cart->product->name }}</h6>
                                <p class="text-muted small mb-1">{{ $cart->product->category->name ?? 'Tanpa Kategori' }}</p>
                                <p class="fw-bold text-success mb-1">Rp{{ number_format($cart->product->price, 0, ',', '.') }}</p>
                                <p class="small mb-0">Kuantitas: <strong>{{ $cart->quantity }}</strong></p>
                                <p class="small text-success mb-2">Subtotal: Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
                                <form action="{{ route('user.cart.destroy', $cart->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger w-100">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="card mt-3 border-0 shadow-sm">
                <div class="card-body text-center">
                    <h6 class="fw-bold mb-2">Total Belanja:</h6>
                    <h5 class="text-success mb-3">Rp{{ number_format($total, 0, ',', '.') }}</h5>
                    <div class="d-grid gap-2">
                        <a href="{{ route('user.products.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Lanjut Belanja
                        </a>
                        <a href="{{ route('user.checkout') }}" class="btn btn-success">
                            <i class="bi bi-credit-card"></i> Lanjut ke Pembayaran
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol bawah untuk desktop --}}
        <div class="text-end mt-4 d-none d-md-block">
            <a href="{{ route('user.products.index') }}" class="btn btn-outline-secondary me-2">
                ← Lanjut Belanja
            </a>
            <a href="{{ route('user.checkout') }}" class="btn btn-success">
                <i class="bi bi-credit-card"></i> Lanjut ke Pembayaran
            </a>
        </div>
    @endif
</div>

{{-- Gaya tambahan --}}
<style>
    .table thead th {
        background: #e9f3ff !important;
        font-weight: 600;
    }
    .card:hover {
        transform: translateY(-3px);
        transition: 0.2s;
    }
</style>
@endsection
