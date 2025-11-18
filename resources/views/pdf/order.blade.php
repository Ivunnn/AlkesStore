<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            background-color: #fff;
        }

        /* Header */
        .header-table {
            width: 100%;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
        }

        .invoice-details {
            text-align: right;
        }

        .invoice-title {
            font-size: 28px;
            font-weight: bold;
            color: #4e73df;
            /* Warna Utama (Bisa diganti sesuai brand) */
            margin: 0;
        }

        /* Info Section */
        .info-table {
            width: 100%;
            margin-bottom: 30px;
        }

        .info-label {
            font-size: 12px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
            display: block;
        }

        .info-content {
            font-size: 15px;
            color: #333;
            font-weight: 500;
        }

        /* Product Table */
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        .product-table th {
            background-color: #f8f9fc;
            color: #333;
            font-weight: bold;
            text-align: left;
            padding: 12px;
            border-bottom: 2px solid #ddd;
            font-size: 13px;
            text-transform: uppercase;
        }

        .product-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .product-table tr:last-child td {
            border-bottom: none;
        }

        .text-right {
            text-align: right;
        }

        /* Totals */
        .total-table {
            width: 40%;
            margin-left: auto;
            /* Align right */
        }

        .total-row td {
            padding: 8px 0;
            text-align: right;
        }

        .grand-total {
            font-size: 18px;
            font-weight: bold;
            color: #4e73df;
            border-top: 2px solid #eee;
            padding-top: 10px !important;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>

<body>

    <div class="container">
        <table class="header-table">
            <tr>
                <td>
                    <div class="company-name">Nama Toko Anda</div>
                    <small style="color: #888;">alkesstore@ecommerce.com</small>
                </td>
                <td class="invoice-details">
                    <h1 class="invoice-title">INVOICE</h1>
                    <p style="margin: 5px 0 0;">ID Pesanan: <strong>#{{ $order->id }}</strong></p>
                    <p style="margin: 0;">Tanggal: {{ $order->created_at->format('d M Y') }}</p>
                </td>
            </tr>
        </table>

        <table class="info-table">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <span class="info-label">Ditagihkan Kepada:</span>
                    <div class="info-content">
                        <strong>{{ $order->user->name }}</strong><br>
                        {{ $order->user->email }}
                    </div>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <span class="info-label">Dikirim Ke:</span>
                    <div class="info-content">
                        <strong>{{ $order->recipient_name }}</strong><br>
                        {{ $order->recipient_phone }}<br>
                        <span style="color: #666; font-size: 14px;">
                            {{ $order->recipient_address }}
                        </span>
                    </div>
                </td>
            </tr>
        </table>

        <table class="product-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Produk</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->product->name }}</strong>
                        </td>
                        <td class="text-right">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="text-right">{{ $item->quantity }}</td>
                        <td class="text-right" style="font-weight: bold;">
                            Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="total-table">
            <tr class="total-row">
                <td style="color: #777;">Metode Bayar:</td>
                <td><strong>{{ strtoupper($order->payment_method) }}</strong></td>
            </tr>
            <tr class="total-row">
                <td class="grand-total">TOTAL PEMBAYARAN</td>
                <td class="grand-total">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="footer">
            <p>Terima kasih telah berbelanja di Toko Kami!</p>
            <p>&copy; {{ date('Y') }} Nama Toko Anda. All rights reserved.</p>
        </div>
    </div>

</body>

</html>