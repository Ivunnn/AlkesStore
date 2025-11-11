<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Vendor')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #007bff;
            color: white;
            padding-top: 1.5rem;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            margin: 4px 10px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .content {
            padding: 2rem;
        }

        .navbar {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="d-flex">
        {{-- Sidebar --}}
        <div class="sidebar p-3">
            <h4 class="text-center fw-bold mb-4">
                <i class="bi bi-shop"></i> Mitra Panel
            </h4>
            <a href="{{ route('vendor.dashboard') }}"
                class="{{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('vendor.products.index') }}"
                class="{{ request()->routeIs('vendor.products') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Produk Saya
            </a>
            <a href="{{ route('vendor.reports.index') }}"
                class="{{ request()->routeIs('vendor.reports') ? 'active' : '' }}">
                <i class="bi bi-graph-up"></i> Laporan
            </a>
            <a href="{{ route('vendor.shops.index') }}"
                class="{{ request()->routeIs('vendor.shops') ? 'active' : '' }}">
                <i class="bi bi-shop-window"></i> Toko Saya
            </a>
            <hr class="border-light">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        {{-- Main Content --}}
        <div class="flex-grow-1">
            <nav class="navbar px-4">
                <div class="container-fluid">
                    <span class="navbar-brand fw-semibold">
                        Selamat datang, {{ Auth::user()->name }}
                    </span>
                </div>
            </nav>

            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>