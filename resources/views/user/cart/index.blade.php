@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<h2 class="mb-4">🛒 Keranjang Belanja</h2>

@if($carts->isEmpty())
    <div class="alert alert-info">
        Keranjang kamu masih kosong.
        <a href="{{ route('user.products.index') }}" class="alert-link">Belanja sekarang</a>.
    </div>
@else
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Kuantitas</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($carts as $cart)
                    @php 
                        $subtotal = $cart->product->price * $cart->quantity;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($cart->product->image)
                                    <img src="{{ asset('storage/'.$cart->product->image) }}" 
                                         alt="{{ $cart->product->name }}" 
                                         width="60" height="60" class="me-3 rounded">
                                @else
                                    <img src="https://via.placeholder.com/60x60?text=No+Image" 
                                         alt="no image" class="me-3 rounded">
                                @endif
                                <div>
                                    <strong>{{ $cart->product->name }}</strong><br>
                                    <small class="text-muted">{{ $cart->product->category->name ?? 'Tanpa Kategori' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>Rp{{ number_format($cart->product->price, 0, ',', '.') }}</td>
                        <td>{{ $cart->quantity }}</td>
                        <td>Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('user.cart.destroy', $cart->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <td colspan="3" class="text-end fw-bold">Total:</td>
                    <td colspan="2" class="fw-bold text-success">Rp{{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="text-end mt-3">
        <a href="{{ route('user.products.index') }}" class="btn btn-secondary">← Lanjut Belanja</a>
        <a href="{{ route('user.checkout') }}" class="btn btn-success">Lanjut ke Pembayaran</a>
    </div>
@endif
@endsection
