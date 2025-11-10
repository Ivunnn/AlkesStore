@extends('layouts.admin')

@section('title', 'Buat Toko Baru')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Buat Toko Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.shops.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Toko</label>
                <input type="text" name="name" class="form-control" id="name" required>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-success">Ajukan</button>
            <a href="{{ route('admin.shops.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
