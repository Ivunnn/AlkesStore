@extends('layouts.admin')

@section('title', 'Edit Role Pengguna')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center text-md-start">
                    <h5 class="mb-0">✏️ Edit Role Pengguna</h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                        </div>

                        {{-- Role --}}
                        <div class="mb-3">
                            <label for="role" class="form-label fw-semibold">Role</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="vendor" {{ $user->role == 'vendor' ? 'selected' : '' }}>Vendor</option>
                                <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                            </select>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary w-100 w-sm-auto">
                                ← Kembali
                            </a>
                            <button type="submit" class="btn btn-success w-100 w-sm-auto">
                                💾 Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center text-muted small">
                    Pastikan role yang dipilih sesuai dengan tanggung jawab pengguna.
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
