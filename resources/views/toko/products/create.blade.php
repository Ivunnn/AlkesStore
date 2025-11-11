@extends('layouts.vendor')

@section('title', 'Tambah Produk')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Tambah Produk Baru</h2>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Nama Produk</label>
        <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Harga</label>
        <input type="number" name="price" id="price" class="form-control" required value="{{ old('price') }}">
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label">Stok</label>
        <input type="number" name="stock" id="stock" class="form-control" required value="{{ old('stock') }}">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea name="description" id="description" rows="4" class="form-control">{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Gambar Produk</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*">
        <small class="text-muted">Format: JPG, PNG, maksimal 2MB</small>
    </div>

    <button type="submit" class="btn btn-success">
        <i class="bi bi-save"></i> Simpan Produk
    </button>
    <a href="{{ route('vendor.products.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
