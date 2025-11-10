@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold">Checkout</h2>

    @if($carts->isEmpty())
        <div class="alert alert-warning">Keranjang kamu masih kosong.</div>
    @else
        <div class="card shadow-sm p-4 mb-4">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($carts as $cart)
                        @php $subtotal = $cart->product->price * $cart->quantity; @endphp
                        <tr>
                            <td>{{ $cart->product->name }}</td>
                            <td>Rp {{ number_format($cart->product->price, 0, ',', '.') }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @php $total += $subtotal; @endphp
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <h4 class="fw-bold mb-0">Total: Rp {{ number_format($total, 0, ',', '.') }}</h4>
            </div>
        </div>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                <select name="payment_method" id="payment_method" class="form-select" required>
                    <option value="">-- Pilih Metode Pembayaran --</option>
                    <option value="transfer_bank">Transfer Bank</option>
                    <option value="cod">Bayar di Tempat (COD)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success w-100">Proses Pesanan</button>
        </form>
    @endif
</div>
@endsection
