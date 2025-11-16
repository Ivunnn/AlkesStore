@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <h3 class="fw-bold mb-3">➕ Tambah Kategori</h3>

        <div class="card border-0 shadow-sm p-4">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Kategori</label>
                    <input type="text" name="name" class="form-control shadow-sm" placeholder="Masukkan nama kategori"
                        value="{{ old('name') }}" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="description" class="form-control shadow-sm" rows="4"
                        placeholder="Deskripsi kategori (opsional)">{{ old('description') }}</textarea>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-primary px-4 shadow-sm">Simpan</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary px-4">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection