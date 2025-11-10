@extends('layouts.admin')

@section('title', 'Daftar Toko Saya')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Mitra AlkesStore</h2>
    <a href="{{ route('admin.shops.create') }}" class="btn btn-primary">+ Daftarkan Mitra</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($shops->isEmpty())
    <div class="alert alert-info">Belum ada mitra yang mengajukan.</div>
@else
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Toko</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shops as $index => $shop)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $shop->name }}</td>
                        <td>{{ $shop->description ?? '-' }}</td>
                        <td>
                            @if($shop->status == 'approved')
                                <span class="badge bg-success">Disetujui</span>
                            @elseif($shop->status == 'pending')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            @if(Auth::user()->role === 'admin')
                                <form action="{{ route('shops.updateStatus', $shop->id) }}" method="POST" class="d-flex gap-1">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="pending" {{ $shop->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $shop->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ $shop->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    <button class="btn btn-sm btn-success">Update</button>
                                </form>
                            @else
                                <em>Tidak ada tindakan</em>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
