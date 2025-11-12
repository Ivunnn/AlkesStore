@extends('layouts.vendor')

@section('title', 'Tambah Produk')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0"><i class="bi bi-box-seam text-dark"></i> Tambah Produk Baru</h4>
            </div>
            <div class="card-body p-4">

                {{-- Pesan error --}}
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Form Tambah Produk --}}
                <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    @csrf

                    <div class="row g-3">
                        {{-- Kategori --}}
                        <div class="col-md-6">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Nama Produk --}}
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                placeholder="Masukkan nama produk" required>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Harga --}}
                        <div class="col-md-6">
                            <label for="price" class="form-label">Harga (Rp)</label>
                            <input type="number" name="price" class="form-control" placeholder="Contoh: 100000" required>
                            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Stok --}}
                        <div class="col-md-6">
                            <label for="stock" class="form-label">Stok</label>
                            <input type="number" name="stock" class="form-control" placeholder="Jumlah stok tersedia"
                                required>
                            @error('stock') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-12">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3"
                                placeholder="Tuliskan deskripsi produk..."></textarea>
                            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Gambar Produk --}}
                        <div class="col-12">
                            <label for="image" class="form-label">Gambar Produk</label>
                            <input type="file" name="image" class="form-control" accept="image/*"
                                onchange="previewImage(event)">
                            <small class="text-muted">Format: JPG, PNG, atau JPEG. Maksimal 2MB.</small>
                            <div class="mt-3 text-center">
                                <img id="preview" src="#" alt="Preview Gambar" class="img-fluid rounded shadow-sm d-none"
                                    style="max-height: 200px;">
                            </div>
                            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="mt-4 d-flex flex-column flex-md-row justify-content-between gap-2">
                        <a href="{{ route('vendor.products.index') }}" class="btn btn-secondary w-100 w-md-auto">
                            <i class="bi bi-arrow-left-circle"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary w-100 w-md-auto">
                            <i class="bi bi-save"></i> Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script Preview Gambar + Validasi --}}
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('d-none');
            }
        }

        // Bootstrap validation
        (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', e => {
                    if (!form.checkValidity()) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>

    {{-- CSS Responsif --}}
    <style>
        @media (max-width: 768px) {

            h1,
            h4 {
                font-size: 1.4rem;
                text-align: center;
            }

            .card-body {
                padding: 1.25rem;
            }
        }
    </style>
@endsection