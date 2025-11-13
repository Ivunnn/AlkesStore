<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitra - AlkesStore</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/30086736_v870-tang-06-removebg-preview.png') }}">

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
            height: 100vh;
            background: linear-gradient(180deg, #0d6efd, #3b82f6);
            color: white;
            padding-top: 1.5rem;
            transition: all 0.3s ease-in-out;
            z-index: 1050;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar h4 {
            text-align: center;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .sidebar a {
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            margin: 5px 10px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background 0.2s ease-in-out, transform 0.2s ease;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateX(4px);
        }

        .sidebar hr {
            border-color: rgba(255, 255, 255, 0.3);
            margin: 1.5rem 0;
        }

        /* Content */
        .main {
            margin-left: 240px;
            transition: margin-left 0.3s ease-in-out;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: white;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            padding: 1rem 1.5rem;
        }

        .navbar .navbar-brand {
            font-weight: 600;
            font-size: 1rem;
        }

        .content {
            flex-grow: 1;
            padding: 2rem;
        }

        /* Sidebar toggle button */
        .toggle-btn {
            display: none;
            background: #0d6efd;
            color: white;
            border: none;
            font-size: 1.5rem;
            padding: 6px 12px;
            border-radius: 8px;
            margin-right: 10px;
        }

        /* Responsive (Mobile & Tablet) */
        @media (max-width: 992px) {
            .sidebar {
                left: -250px;
            }

            .sidebar.active {
                left: 0;
            }

            .main {
                margin-left: 0;
            }

            .toggle-btn {
                display: block;
            }
        }
    </style>
</head>

<body>

    {{-- Sidebar --}}
    <div class="sidebar" id="sidebar">
        <h4><i class="bi bi-shop"></i> Mitra Panel</h4>

        <a href="{{ route('vendor.dashboard') }}" class="{{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="{{ route('vendor.products.index') }}"
            class="{{ request()->routeIs('vendor.products*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Produk Saya
        </a>

        <a href="{{ route('vendor.reports.index') }}"
            class="{{ request()->routeIs('vendor.reports*') ? 'active' : '' }}">
            <i class="bi bi-graph-up"></i> Laporan
        </a>

        <a href="{{ route('vendor.shops.index') }}" class="{{ request()->routeIs('vendor.shops*') ? 'active' : '' }}">
            <i class="bi bi-shop-window"></i> Toko Saya
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

    {{-- Main Section --}}
    <div class="main">
        <nav class="navbar d-flex align-items-center">
            <button class="toggle-btn" id="toggleSidebar"><i class="bi bi-list"></i></button>
            <span class="navbar-brand mb-0">{{ Auth::user()->name }}</span>
        </nav>

        <div class="content">
            @yield('content')
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Sidebar Toggle Script --}}
    <script>
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    </script>
</body>

</html>