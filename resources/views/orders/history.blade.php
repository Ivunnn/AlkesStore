@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold">Riwayat Pesanan</h2>

    @if (session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info">Belum ada pesanan yang dibuat.</div>
    @else
        @foreach($orders as $order)
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <strong>Kode Pesanan: #{{ $order->id }}</strong>
                    <span class="badge text-bg-success">{{ ucfirst($order->status) }}</span>
                </div>
                <div class="card-body">
                    <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                    <p><strong>Metode Pembayaran:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>

                    <table class="table table-sm table-bordered mt-3">
                        <thead class="table-light">
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-end mt-2 fw-bold">
                        Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
