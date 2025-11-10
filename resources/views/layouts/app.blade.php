<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Online Shopping System' }}</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    {{-- Custom CSS (opsional) --}}
    <style>
        body {
            background-color: #f8f9fa;
        }

        nav.navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #fff;
            border-top: 1px solid #ddd;
            padding: 20px 0;
            margin-top: 40px;
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    @include('partials.navbar')

    @if (session('success'))
        <div class="alert alert-success text-center mb-0 rounded-0">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger text-center mb-0 rounded-0">
            {{ session('error') }}
        </div>
    @endif


    {{-- Konten Utama --}}
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Script tambahan --}}
    @stack('scripts')
</body>

</html>