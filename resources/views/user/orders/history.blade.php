@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">📦 Riwayat Pesanan Kamu</h3>

        @forelse ($orders as $order)
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <div>
                        <strong class="text-primary">#{{ $order->id }}</strong>
                        <span class="ms-2 text-muted small">
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </span>
                    </div>

                    {{-- Status Badge --}}
                    <span class="badge 
                        @if($order->status == 'pending') bg-warning text-dark
                        @elseif($order->status == 'verified') bg-success
                        @elseif($order->status == 'rejected') bg-danger
                        @else bg-secondary
                        @endif
                    ">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="card-body">

                    {{-- Data Penerima --}}
                    <div class="mb-3">
                        <h6 class="fw-bold mb-1">📍 Data Penerima</h6>
                        <p class="mb-0"><strong>{{ $order->recipient_name }}</strong></p>
                        <p class="mb-0">{{ $order->recipient_phone }}</p>
                        <p class="mb-1 text-muted small">{{ $order->recipient_address }}</p>
                    </div>

                    <hr>

                    {{-- List Produk --}}
                    <div class="mb-3">
                        <h6 class="fw-bold mb-2">🛒 Produk Pesanan</h6>

                        @foreach ($order->orderItems as $item)
                            <div class="d-flex align-items-center mb-3">
                                {{-- Gambar Produk --}}
                                <img src="{{ $item->product->image 
                                    ? asset('storage/' . $item->product->image) 
                                    : 'https://via.placeholder.com/60x60?text=No+Img' }}"
                                    class="rounded border"
                                    style="width:60px; height:60px; object-fit:cover;">

                                <div class="ms-3">
                                    <p class="mb-0 fw-semibold">{{ $item->product->name }}</p>
                                    <p class="small text-muted mb-0">
                                        x{{ $item->quantity }} &middot; 
                                        Rp{{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                    <p class="fw-bold text-success mb-0">
                                        Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <hr>

                    {{-- Total Harga --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Total Pembayaran:</h5>
                        <h5 class="text-success mb-0">Rp{{ number_format($order->total_price, 0, ',', '.') }}</h5>
                    </div>


                </div>
            </div>
        @empty
            <div class="alert alert-info text-center py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" width="120" class="opacity-75 mb-3">
                <h5 class="text-muted">Belum ada pesanan</h5>
                <p class="text-secondary">Ayo mulai belanja sekarang!</p>
                <a href="{{ route('user.products.index') }}" class="btn btn-primary">Belanja Produk</a>
            </div>
        @endforelse
    </div>

    <style>
        .card:hover {
            transform: translateY(-3px);
            transition: 0.2s ease-in-out;
        }
    </style>
@endsection
