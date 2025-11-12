@extends('layouts.app')

@section('title', 'Kirim Feedback')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-3">Kirim Feedback ke Admin</h4>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('user.feedback.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="subject" class="form-label">Subjek</label>
                    <input type="text" name="subject" id="subject" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Pesan</label>
                    <textarea name="message" id="message" rows="4" class="form-control" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Kirim Feedback</button>
            </form>
        </div>
    </div>
@endsection