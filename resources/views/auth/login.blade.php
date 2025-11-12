@extends('layouts.app')

@section('title', 'Login - AlkesStore')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <h4 class="text-center mb-4 fw-bold">Login</h4>

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('login.submit') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-3">Masuk</button>

                            <div class="text-center mt-3">
                                <small>Belum punya akun?
                                    <a href="{{ route('register') }}" class="text-decoration-none">Daftar sekarang</a>
                                </small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Responsiveness tambahan --}}
    @push('styles')
        <style>
            @media (max-width: 576px) {
                .card {
                    border-radius: 10px;
                }

                .card-body {
                    padding: 1.5rem !important;
                }

                h4 {
                    font-size: 1.3rem;
                }

                button.btn {
                    font-size: 0.9rem;
                    padding: 0.6rem;
                }
            }
        </style>
    @endpush
@endsection