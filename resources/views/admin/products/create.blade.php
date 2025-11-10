@extends('layouts.admin')

@section('title', 'Tambah Produk - Admin')

@section('content')
<div class="container-fluid">
    <h2 class="fw-bold mb-4"><i class="bi bi-plus-circle"></i> Tambah Produk</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="shop_id" class="form-label fw-semibold">Toko</label>
                    <select name="shop_id" id="shop_id" class="form-select" required>
                        <option value="">-- Pilih Toko --</option>
                        @foreach ($shops as $shop)
                            <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                        @endforeach
                    </select>
                    @error('shop_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label fw-semibold">Kategori</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Produk</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label fw-semibold">Harga</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                        @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="stock" class="form-label fw-semibold">Stok</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                        @error('stock') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label fw-semibold">Gambar Produk</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
