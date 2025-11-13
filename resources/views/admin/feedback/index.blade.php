@extends('layouts.admin')

@section('title', 'Daftar Feedback')

@section('content')
<h2 class="mb-4 fw-bold">
    <i class="bi bi-star"></i> Ulasan Pengguna
</h2>

@if($feedbacks->isEmpty())
    <div class="alert alert-info">Belum ada feedback dari pengguna.</div>
@else
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Subjek</th>
                    <th>Pesan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($feedbacks as $i => $feedback)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $feedback->user->name }}</td>
                        <td>{{ $feedback->subject }}</td>
                        <td>{{ $feedback->message }}</td>
                        <td>{{ $feedback->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
