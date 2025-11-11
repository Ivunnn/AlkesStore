@extends('layouts.vendor')

@section('title', 'Toko Saya')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">🏪 Informasi Toko Saya</h2>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Jika belum punya toko --}}
    @if (!$shop)
        <div class="alert alert-info">
            Anda belum memiliki toko.  
            <a href="{{ route('vendor.shops.create') }}" class="btn btn-primary btn-sm ms-2">Buat Toko Sekarang</a>
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title">{{ $shop->name }}</h4>
                <p class="text-muted">{{ $shop->description ?? 'Belum ada deskripsi' }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge bg-success">{{ ucfirst($shop->status) }}</span>
                </p>

                <a href="{{ route('vendor.shops.create') }}" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Edit Toko
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
