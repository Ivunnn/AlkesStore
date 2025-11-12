@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
    <div class="container mt-4">
        <h3>Riwayat Pesanan</h3>

        @forelse ($orders as $order)
            <div class="card mb-3">
                <div class="card-header">
                    <strong>Pesanan #{{ $order->id }}</strong> - {{ ucfirst($order->status) }}
                </div>
                <div class="card-body">
                    <p><strong>Total:</strong> Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                    <p><strong>Metode:</strong> {{ ucfirst($order->payment_method) }}</p>
                    <hr>
                    <ul>
                        @foreach ($order->orderItems as $item)
                            <li>
                                {{ $item->product->name }} (x{{ $item->quantity }}) -
                                Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @empty
            <div class="alert alert-info">Belum ada pesanan.</div>
        @endforelse
    </div>
@endsection