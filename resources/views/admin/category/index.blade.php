@extends('layouts.admin')

@section('content')
    <div class="container py-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
            <h3 class="fw-bold m-0">📂 Manajemen Kategori</h3>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary shadow-sm px-4">
                + Tambah Kategori
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body table-responsive">

                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th class="text-center" width="160px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td class="fw-semibold">{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $category->name }}</td>
                                <td class="text-muted">
                                    {{ $category->description ? Str::limit($category->description, 40) : '-' }}
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="btn btn-warning btn-sm px-3 shadow-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm px-3 shadow-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Belum ada kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $categories->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection