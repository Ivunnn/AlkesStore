@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <h3 class="fw-bold mb-3">✏️ Edit Kategori</h3>

        <div class="card border-0 shadow-sm p-4">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Kategori</label>
                    <input type="text" name="name" class="form-control shadow-sm" value="{{ $category->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="description" class="form-control shadow-sm"
                        rows="4">{{ $category->description }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-warning px-4 shadow-sm">Update</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary px-4">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection