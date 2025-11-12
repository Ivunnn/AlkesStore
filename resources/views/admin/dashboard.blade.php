@extends('layouts.admin')

@section('title', 'Dashboard Admin - AlkesStore')

@section('content')
    <div class="container-fluid py-3">
        <h1 class="fw-bold mb-4 text-center text-md-start">
            <i class="bi bi-speedometer2"></i> Dashboard Admin
        </h1>

        @if (session('success'))
            <div class="alert alert-success text-center text-md-start">{{ session('success') }}</div>
        @endif

        <div class="row g-4">
            {{-- Card Produk --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-box-seam fs-1 text-primary"></i>
                        <h5 class="mt-3">Produk</h5>
                        <p class="text-muted mb-1">Total: {{ \App\Models\Product::count() }}</p>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-primary mt-2 w-100">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

            {{-- Card Toko --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-shop fs-1 text-success"></i>
                        <h5 class="mt-3">Toko</h5>
                        <p class="text-muted mb-1">Total: {{ \App\Models\Shop::count() }}</p>
                        <a href="{{ route('admin.shops.index') }}" class="btn btn-sm btn-success mt-2 w-100">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

            {{-- Card Pesanan (jika ingin diaktifkan kembali) --}}
            {{--
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-basket fs-1 text-warning"></i>
                        <h5 class="mt-3">Pesanan</h5>
                        <p class="text-muted mb-1">Total: {{ \App\Models\Order::count() }}</p>
                        <a href="{{ route('orders.history') }}" class="btn btn-sm btn-warning mt-2 w-100">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>
            --}}

            {{-- Card Pengguna --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-people fs-1 text-danger"></i>
                        <h5 class="mt-3">Pengguna</h5>
                        <p class="text-muted mb-1">Total: {{ \App\Models\User::count() }}</p>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-danger mt-2 w-100">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Style tambahan agar card responsif lebih halus --}}
    <style>
        @media (max-width: 576px) {
            .card-body i {
                font-size: 2rem !important;
            }

            .card-body h5 {
                font-size: 1rem;
            }

            .card-body p {
                font-size: 0.9rem;
            }
        }
    </style>
@endsection