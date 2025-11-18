@component('mail::message')
# Pesanan Kamu Berhasil Dibuat 🎉

Halo **{{ $order->user->name }}**,  
Terima kasih sudah melakukan pemesanan di toko kami.

Berikut detail pesanan kamu:

@component('mail::table')
| Produk | Qty | Harga | Subtotal |
|--------|-----|--------|----------|
@foreach ($order->orderItems as $item)
| {{ $item->product->name }} | {{ $item->quantity }} | Rp{{ number_format($item->price) }} | Rp{{ number_format($item->subtotal) }} |
@endforeach
@endcomponent

**Total: Rp{{ number_format($order->total_price) }}**

Status pesanan saat ini: **Menunggu verifikasi vendor**

@component('mail::button', ['url' => route('user.orders.history')])
Lihat Pesanan
@endcomponent

Terima kasih,  
{{ config('app.name') }}
@endcomponent
