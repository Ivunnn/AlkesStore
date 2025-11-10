<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Custom Style --}}
    <style>
        body {
            background-color: #f8fafc;
        }

        .sidebar {
            min-height: 100vh;
            background: #0d6efd;
            color: white;
            width: 240px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 8px;
        }

        .content {
            margin-left: 240px;
            padding: 30px;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        <div class="sidebar p-3">
            <h4 class="fw-bold mb-4 text-center">🛍️ AlkesStore</h4>

            <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="{{ route('admin.products.index') }}" class="{{ request()->is('admin/products') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Produk
            </a>

            <a href="{{ route('admin.shops.index') }}" class="{{ request()->is('admin/shops') ? 'active' : '' }}">
                <i class="bi bi-shop"></i> Toko
            </a>

            {{-- <a href="{{ route('orders.history') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="bi bi-basket"></i> Pesanan
            </a> --}}

            <a href="{{ route('admin.reports.index') }}" class="{{ request()->is('admin/reports') ? 'active' : '' }}">
                <i class="bi bi-book"></i> Report
            </a>

            <a href="{{ route('admin.users.index') }}" class="{{ request()->is('admin/users') ? 'active' : '' }}">
                <i class="bi bi-person"></i> User
            </a>

            <hr>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        {{-- Main Content --}}
        <div class="content w-100">
            @yield('content')
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>