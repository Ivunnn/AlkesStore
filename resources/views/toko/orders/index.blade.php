@extends('layouts.vendor')

@section('content')
    <h3>Verifikasi Pesanan</h3>

    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Total</th>
                <th>Bukti</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->user->name }}</td>
                    <td>Rp{{ number_format($order->total_price) }}</td>

                    <td>
                        <img src="{{ asset('storage/' . $order->payment_proof) }}" width="120">
                    </td>

                    <td>
                        @if($order->vendor_status === 'approved')
                            <span class="badge bg-success">Disetujui</span>

                        @elseif($order->vendor_status === 'rejected')
                            <span class="badge bg-danger">Ditolak</span>

                        @else
                            <span class="badge bg-secondary">Pending</span>
                        @endif
                    </td>

                    <td>
                        {{-- SHOW ACTIONS ONLY IF STATUS PENDING --}}
                        @if($order->vendor_status === 'pending')
                            <form action="{{ route('vendor.orders.approve', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-success btn-sm">Approve</button>
                            </form>

                            <form action="{{ route('vendor.orders.reject', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @else
                            <em>Tidak ada aksi</em>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection