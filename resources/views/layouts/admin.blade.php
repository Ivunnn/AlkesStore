<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Custom Style --}}
    <style>
        body {
            background-color: #f5f7fb;
            overflow-x: hidden;
            font-family: "Poppins", sans-serif;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 220px;
            background: linear-gradient(180deg, #0d6efd, #3b82f6);
            color: #fff;
            transition: all 0.3s ease;
            z-index: 1050;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar h4 {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            letter-spacing: 0.5px;
        }

        .sidebar a {
            color: #f1f1f1;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 14px;
            margin-bottom: 6px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            font-size: 0.95rem;
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            transform: translateX(4px);
        }

        .sidebar hr {
            border-color: rgba(255, 255, 255, 0.25);
        }

        /* Main content */
        .content {
            margin-left: 230px;
            padding: 25px 30px;
            transition: all 0.3s ease;
        }

        /* Sidebar toggle (mobile) */
        .sidebar-toggle {
            display: none;
            background: #0d6efd;
            color: white;
            border: none;
            padding: 8px 12px;
            font-size: 1.25rem;
            border-radius: 8px;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1100;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }

        /* Mobile & Tablet Responsiveness */
        @media (max-width: 992px) {
            .sidebar {
                left: -230px;
            }

            .sidebar.active {
                left: 0;
            }

            .content {
                margin-left: 0;
                padding: 20px;
            }

            .sidebar-toggle {
                display: block;
            }
        }

        /* Tambahan visual improvement */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(255,255,255,0.3);
            border-radius: 10px;
        }
    </style>
</head>

<body>
    {{-- Tombol Toggle Sidebar (muncul di HP/tablet) --}}
    <button class="sidebar-toggle" id="toggleSidebar">
        <i class="bi bi-list"></i>
    </button>

    {{-- Sidebar --}}
    <div class="sidebar p-3" id="sidebarMenu">
        <h4 class="fw-bold text-center mb-4">🛍️ AlkesStore</h4>

        <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="{{ route('admin.products.index') }}" class="{{ request()->is('admin/products') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Produk
        </a>

        {{-- <a href="{{ route('admin.shops.index') }}" class="{{ request()->is('admin/shops') ? 'active' : '' }}">
            <i class="bi bi-shop"></i> Toko
        </a> --}}

        <a href="{{ route('admin.reports.index') }}" class="{{ request()->is('admin/reports') ? 'active' : '' }}">
            <i class="bi bi-book"></i> Report
        </a>

        <a href="{{ route('admin.feedback.index') }}" class="{{ request()->is('admin/reports') ? 'active' : '' }}">
            <i class="bi bi-star"></i> Feedback
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
    <div class="content">
        @yield('content')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Toggle Sidebar Script --}}
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebarMenu').classList.toggle('active');
        });
    </script>
</body>
</html>
