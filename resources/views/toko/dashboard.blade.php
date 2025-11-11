@extends('layouts.vendor')

@section('title', 'Dashboard Vendor')

@section('content')
<div class="container-fluid">
    <h1 class="fw-bold mb-4"><i class="bi bi-speedometer2"></i> Dashboard Mitra</h1>

    <div class="alert alert-info">
        <strong>Halo, {{ Auth::user()->name }}!</strong><br>
        Selamat datang di panel mitra AlkesStore.
    </div>

    <div class="row g-3 mt-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-box-seam display-5 text-primary"></i>
                    <h5 class="mt-3">Produk Saya</h5>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary mt-2">Kelola Produk</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-graph-up display-5 text-success"></i>
                    <h5 class="mt-3">Laporan Penjualan</h5>
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-success mt-2">Lihat Laporan</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-shop-window display-5 text-warning"></i>
                    <h5 class="mt-3">Toko Saya</h5>
                    <a href="{{ route('admin.shops.index') }}" class="btn btn-outline-warning mt-2">Kelola Toko</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
