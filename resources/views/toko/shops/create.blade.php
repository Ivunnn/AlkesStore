@extends('layouts.vendor')

@section('title', 'Buat / Edit Toko')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">🛍️ {{ isset($shop) ? 'Edit Toko' : 'Buat Toko Baru' }}</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('vendor.shops.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Toko <span class="text-danger">*</span></label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        value="{{ old('name', $shop->name ?? '') }}" 
                        required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        class="form-control" 
                        rows="4">{{ old('description', $shop->description ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    💾 Simpan
                </button>
                <a href="{{ route('vendor.shops.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
