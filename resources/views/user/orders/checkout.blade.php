@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="container mt-4">
        <h3>Checkout</h3>

        @if($carts->isEmpty())
            <div class="alert alert-warning">
                Keranjang kamu kosong. <a href="{{ route('user.products.index') }}">Belanja sekarang</a>.
            </div>
        @else
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($carts as $cart)
                        @php $subtotal = $cart->product->price * $cart->quantity;
                        $total += $subtotal; @endphp
                        <tr>
                            <td>{{ $cart->product->name }}</td>
                            <td>Rp{{ number_format($cart->product->price, 0, ',', '.') }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h4 class="mt-3">Total: <span class="text-success">Rp{{ number_format($total, 0, ',', '.') }}</span></h4>

            <form action="{{ route('user.checkout.store') }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="payment_method" class="form-label">Metode Pembayaran</label>
                    <select name="payment_method" id="payment_method" class="form-control" required>
                        <option value="">-- Pilih Metode Pembayaran --</option>
                        <option value="transfer">Transfer Bank</option>
                        <option value="cod">Bayar di Tempat (COD)</option>
                        <option value="ewallet">E-Wallet</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Buat Pesanan
                </button>
            </form>
        @endif
    </div>
@endsection