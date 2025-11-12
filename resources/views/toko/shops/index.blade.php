@extends('layouts.vendor')

@section('title', 'Toko Saya')

@section('content')
    <div class="container py-4">
        <h2 class="fw-bold mb-4 text-dark d-flex align-items-center gap-2 flex-wrap text-center text-md-start">
            🏪 Informasi Toko Saya
        </h2>

        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="alert alert-success shadow-sm border-0 rounded-3">
                {{ session('success') }}
            </div>
        @endif

        {{-- Jika belum punya toko --}}
        @if (!$shop)
            <div
                class="alert alert-info shadow-sm border-0 rounded-3 text-center text-md-start d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                <div>
                    Anda belum memiliki toko. Silakan buat toko untuk mulai berjualan.
                </div>
                <a href="{{ route('vendor.shops.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Buat Toko Sekarang
                </a>
            </div>
        @else
            <div class="card shadow-sm border-0 rounded-4 mt-3 hover-card">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                        <div class="mb-3 mb-md-0">
                            <h4 class="fw-semibold mb-2">{{ $shop->name }}</h4>
                            <p class="text-muted mb-1">{{ $shop->description ?? 'Belum ada deskripsi' }}</p>
                            <p class="mb-0">
                                <strong>Status:</strong>
                                <span class="badge {{ $shop->status == 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($shop->status) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('vendor.shops.create') }}" class="btn btn-warning">
                                <i class="bi bi-pencil-square"></i> Edit Toko
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Responsif dan efek hover --}}
    <style>
        .hover-card {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 576px) {
            h2 {
                font-size: 1.4rem;
                text-align: center;
            }

            .btn {
                width: 100%;
                font-size: 0.95rem;
            }

            .card-body h4 {
                font-size: 1.1rem;
            }

            .card-body p {
                font-size: 0.9rem;
            }

            .alert {
                text-align: center;
                font-size: 0.9rem;
            }
        }

        @media (min-width: 577px) and (max-width: 991px) {
            .card-body h4 {
                font-size: 1.25rem;
            }

            .card-body p {
                font-size: 0.95rem;
            }
        }
    </style>
@endsection