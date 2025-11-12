@extends('layouts.vendor')

@section('title', 'Dashboard Vendor')

@section('content')
<div class="container-fluid py-4">
    <h1 class="fw-bold mb-4 text-dark d-flex align-items-center gap-2 flex-wrap text-center text-md-start">
        <i class="bi bi-speedometer2"></i> Dashboard Mitra
    </h1>

    <div class="alert alert-info shadow-sm border-0 rounded-3 text-center text-md-start">
        <strong>Halo, {{ Auth::user()->name }}!</strong><br>
        Selamat datang di panel mitra <strong>AlkesStore</strong>. Kelola toko dan produk Anda dengan mudah.
    </div>

    <div class="row g-4 mt-3">
        {{-- Produk Saya --}}
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm border-0 h-100 hover-card">
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <i class="bi bi-box-seam display-5 text-primary mb-3"></i>
                    <h5 class="fw-semibold">Produk Saya</h5>
                    <p class="text-muted small">Lihat dan kelola semua produk yang Anda jual.</p>
                    <a href="{{ route('vendor.products.index') }}" class="btn btn-outline-primary w-100 mt-2">
                        <i class="bi bi-arrow-right-circle"></i> Kelola Produk
                    </a>
                </div>
            </div>
        </div>

        {{-- Laporan Penjualan --}}
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm border-0 h-100 hover-card">
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <i class="bi bi-graph-up display-5 text-success mb-3"></i>
                    <h5 class="fw-semibold">Laporan Penjualan</h5>
                    <p class="text-muted small">Pantau performa dan perkembangan penjualan toko Anda.</p>
                    <a href="{{ route('vendor.reports.index') }}" class="btn btn-outline-success w-100 mt-2">
                        <i class="bi bi-bar-chart-line"></i> Lihat Laporan
                    </a>
                </div>
            </div>
        </div>

        {{-- Toko Saya --}}
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm border-0 h-100 hover-card">
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <i class="bi bi-shop-window display-5 text-warning mb-3"></i>
                    <h5 class="fw-semibold">Toko Saya</h5>
                    <p class="text-muted small">Perbarui profil toko dan informasi bisnis Anda.</p>
                    <a href="{{ route('vendor.shops.index') }}" class="btn btn-outline-warning w-100 mt-2">
                        <i class="bi bi-shop"></i> Kelola Toko
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tambahkan efek hover dan responsif --}}
<style>
    .hover-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        border-radius: 1rem;
    }

    .hover-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    }

    /* Responsif untuk HP kecil */
    @media (max-width: 576px) {
        h1 {
            font-size: 1.5rem;
            justify-content: center;
        }

        .card-body i {
            font-size: 2.3rem;
        }

        .card-body h5 {
            font-size: 1.1rem;
        }

        .card-body p {
            font-size: 0.85rem;
        }

        .btn {
            font-size: 0.9rem;
        }

        .alert {
            font-size: 0.9rem;
        }
    }

    /* Untuk tablet menengah (600–992px) */
    @media (min-width: 577px) and (max-width: 991px) {
        .card-body i {
            font-size: 3rem;
        }

        .card-body h5 {
            font-size: 1.2rem;
        }

        .card-body p {
            font-size: 0.9rem;
        }
    }
</style>
@endsection
