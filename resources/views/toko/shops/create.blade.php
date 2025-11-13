@extends('layouts.vendor')

@section('title', 'Buat / Edit Toko')

@section('content')
    <div class="container py-4">
        <h2 class="fw-bold mb-4 text-dark d-flex align-items-center gap-2 flex-wrap text-center text-md-start">
            🛍️ {{ isset($shop) ? 'Edit Toko' : 'Ubah Profil' }}
        </h2>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                <form action="{{ route('vendor.shops.store') }}" method="POST">
                    @csrf

                    {{-- Nama Toko --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Mitra <span
                                class="text-danger">*</span></label>
                        <input type="text" id="name" name="name"
                            class="form-control form-control-lg @error('name') is-invalid @enderror"
                            placeholder="Masukkan nama mitra Anda" value="{{ old('name', $shop->name ?? '') }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Deskripsi Toko</label>
                        <textarea id="description" name="description" class="form-control" rows="4"
                            placeholder="Tuliskan deskripsi singkat tentang mitra Anda...">{{ old('description', $shop->description ?? '') }}</textarea>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex flex-column flex-md-row gap-2 mt-4">
                        <button type="submit" class="btn btn-success flex-fill">
                            💾 Simpan
                        </button>
                        <a href="{{ route('vendor.shops.index') }}" class="btn btn-secondary flex-fill">
                            ⬅️ Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- CSS Responsif & Estetika --}}
    <style>
        .card {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        label {
            color: #333;
        }

        textarea,
        input {
            border-radius: 10px;
        }

        .btn {
            border-radius: 10px;
            font-weight: 600;
        }

        @media (max-width: 576px) {
            h2 {
                font-size: 1.4rem;
                text-align: center;
            }

            .form-control-lg {
                font-size: 1rem;
                padding: 0.75rem 1rem;
            }

            .btn {
                width: 100%;
                font-size: 0.95rem;
            }

            .card-body {
                padding: 1.25rem;
            }
        }

        @media (min-width: 577px) and (max-width: 991px) {
            .card-body {
                padding: 2rem;
            }

            .btn {
                font-size: 1rem;
            }
        }
    </style>
@endsection