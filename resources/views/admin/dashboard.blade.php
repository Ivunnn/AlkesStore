@extends('layouts.admin')

@section('title', 'Dashboard Admin - AlkesStore')

@section('content')
<div class="container-fluid">
    <h1 class="fw-bold mb-4"><i class="bi bi-speedometer2"></i> Dashboard Admin</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-box-seam fs-1 text-primary"></i>
                    <h5 class="mt-3">Produk</h5>
                    <p class="text-muted mb-1">Total: {{ \App\Models\Product::count() }}</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-primary mt-2">Lihat</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-shop fs-1 text-success"></i>
                    <h5 class="mt-3">Toko</h5>
                    <p class="text-muted mb-1">Total: {{ \App\Models\Shop::count() }}</p>
                    <a href="{{ route('admin.shops.index') }}" class="btn btn-sm btn-success mt-2">Lihat</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-basket fs-1 text-warning"></i>
                    <h5 class="mt-3">Pesanan</h5>
                    <p class="text-muted mb-1">Total: {{ \App\Models\Order::count() }}</p>
                    <a href="{{ route('orders.history') }}" class="btn btn-sm btn-warning mt-2">Lihat</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-people fs-1 text-danger"></i>
                    <h5 class="mt-3">Pengguna</h5>
                    <p class="text-muted mb-1">Total: {{ \App\Models\User::count() }}</p>
                    <a href="#" class="btn btn-sm btn-danger mt-2">Lihat</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
