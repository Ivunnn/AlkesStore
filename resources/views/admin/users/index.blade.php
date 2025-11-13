@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="container-fluid position-relative">
    {{-- Header & tombol tambah user --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3 position-relative">
        <h1 class="h4 mb-0">Manajemen Pengguna</h1>

        {{-- Tombol di pojok kanan --}}
        <div class="position-absolute top-0 end-0 mt-2 me-3 d-none d-md-block">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm shadow">
                + Tambah User
            </a>
        </div>

        {{-- Untuk mobile (agar tetap terlihat di bawah judul) --}}
        <div class="d-block d-md-none w-100">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm w-100">
                + Tambah User
            </a>
        </div>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- ===== Desktop / Tablet: Tabel (md ke atas) ===== --}}
    <div class="table-responsive d-none d-md-block">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr class="text-center">
                    <th style="width:60px">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th style="width:120px">Role</th>
                    <th style="width:140px">Dibuat</th>
                    <th style="width:160px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr>
                        <td class="text-center">{{ $index + $users->firstItem() }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">
                            <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'vendor' ? 'warning text-dark' : 'secondary') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="text-center">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Belum ada pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ===== Mobile: Card list (sm & xs) ===== --}}
    <div class="d-md-none">
        @forelse ($users as $index => $user)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-1">{{ $user->name }}</h6>
                            <p class="mb-1 text-muted small">{{ $user->email }}</p>
                            <div class="mb-2 text-white">
                                <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'vendor' ? 'warning text-white' : 'secondary') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                                <small class="ms-2">Dibuat: {{ $user->created_at->format('d M Y') }}</small>
                            </div>
                        </div>

                        <div class="ms-2 text-end">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary mb-2 d-block">Edit</a>

                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger w-100">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">Belum ada pengguna.</div>
        @endforelse
    </div>

    {{-- Pagination & show count --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3 gap-2">
        <div class="text-muted small">
            Menampilkan <strong>{{ $users->count() }}</strong> dari
            <strong>{{ $users->total() ?? $users->count() }}</strong> pengguna
        </div>

        <div>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
