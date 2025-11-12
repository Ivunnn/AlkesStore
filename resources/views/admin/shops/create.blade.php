@extends('layouts.admin')

@section('title', 'Buat Toko Baru')

@section('content')
    <div class="container-fluid px-3">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                <div class="card shadow-lg border-0 rounded-3">
                    <div
                        class="card-header bg-gradient bg-primary text-white d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fw-semibold">
                            🏪 Tambahkan Mitra Baru
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('admin.shops.store') }}" method="POST" novalidate>
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Nama Mitra <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name"
                                    class="form-control form-control-lg shadow-sm @error('name') is-invalid @enderror"
                                    id="name" placeholder="Masukkan nama mitra..." required>
                                @error('name')
                                    <div class="invalid-feedback mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-semibold">Deskripsi</label>
                                <textarea name="description" class="form-control shadow-sm" id="description" rows="4"
                                    placeholder="Deskripsi mitra..."></textarea>
                                @error('description')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex flex-wrap justify-content-between mt-4 gap-2">
                                <a href="{{ route('admin.shops.index') }}" class="btn btn-outline-secondary px-4">
                                    ← Kembali
                                </a>
                                <button type="submit" class="btn btn-success px-4 shadow-sm">
                                    ✅ Ajukan Toko
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer text-center text-muted small py-2">
                        Pastikan data toko sudah benar sebelum diajukan.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection