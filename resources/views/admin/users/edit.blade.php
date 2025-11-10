@extends('layouts.admin')

@section('title', 'Edit Role Pengguna')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Role Pengguna</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" value="{{ $user->name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" value="{{ $user->email }}" readonly>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="vendor" {{ $user->role == 'vendor' ? 'selected' : '' }}>Vendor</option>
                <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
