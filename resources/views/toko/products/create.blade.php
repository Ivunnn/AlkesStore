@extends('layouts.vendor')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Produk Baru</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" name="stock" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Produk</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Produk</button>
    </form>
</div>
@endsection
