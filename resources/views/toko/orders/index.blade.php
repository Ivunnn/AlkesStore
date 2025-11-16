@extends('layouts.vendor')

@section('content')
    <div class="container-fluid">

        <h3 class="mb-4 fw-bold">Verifikasi Pesanan</h3>

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>User</th>
                                <th>Total</th>
                                <th>Bukti</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="fw-semibold">{{ $order->user->name }}</td>

                                    <td class="fw-semibold text-success">
                                        Rp{{ number_format($order->total_price) }}
                                    </td>

                                    <td>
                                        <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $order->payment_proof) }}" class="img-thumbnail"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                        </a>
                                        <small class="text-muted d-block">Klik untuk perbesar</small>
                                    </td>

                                    <td>
                                        @if($order->vendor_status === 'approved')
                                            <span class="badge bg-success px-3 py-2">Disetujui</span>

                                        @elseif($order->vendor_status === 'rejected')
                                            <span class="badge bg-danger px-3 py-2">Ditolak</span>

                                        @else
                                            <span class="badge bg-secondary px-3 py-2">Pending</span>
                                        @endif
                                    </td>

                                    <td class="text-center">

                                        {{-- SHOW ACTIONS ONLY IF STATUS PENDING --}}
                                        @if($order->vendor_status === 'pending')

                                            <form action="{{ route('vendor.orders.approve', $order->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button class="btn btn-success btn-sm">
                                                    <i class="fas fa-check me-1"></i> Approve
                                                </button>
                                            </form>

                                            <form action="{{ route('vendor.orders.reject', $order->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-times me-1"></i> Reject
                                                </button>
                                            </form>

                                        @else

                                            <span class="text-muted">Tidak ada aksi</span>

                                        @endif

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection