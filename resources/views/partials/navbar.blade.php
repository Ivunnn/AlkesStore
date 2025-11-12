<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        {{-- Brand --}}
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home') }}">
            <i class="fa-solid fa-stethoscope text-primary"></i>
            <span class="text-dark">AlkesStore</span>
        </a>

        {{-- Button toggler untuk mobile --}}
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars fs-4 text-primary"></i>
        </button>

        {{-- Menu Navigasi --}}
        <div class="collapse navbar-collapse mt-2 mt-lg-0" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link px-3 {{ request()->routeIs('home') ? 'active text-primary fw-semibold' : '' }}">
                        Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.products.index') }}"
                        class="nav-link px-3 {{ request()->routeIs('user.products.*') ? 'active text-primary fw-semibold' : '' }}">
                        Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.cart.index') }}"
                        class="nav-link px-3 {{ request()->routeIs('user.cart.*') ? 'active text-primary fw-semibold' : '' }}">
                        Keranjang
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('user.orders.history') }}"
                        class="nav-link px-3 {{ request()->routeIs('user.orders.*') ? 'active text-primary fw-semibold' : '' }}">
                        Pesanan
                    </a>
                </li> --}}

                {{-- Kondisi Auth --}}
                @guest
                    <li class="nav-item mt-2 mt-lg-0 px-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm me-2 w-100">Login</a>
                    </li>
                    <li class="nav-item mt-2 mt-lg-0">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm w-100">Register</a>
                    </li>
                @else
                    <li class="nav-item dropdown mt-2 mt-lg-0">
                        <a class="nav-link dropdown-toggle px-3 d-flex align-items-center" href="#" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user me-2"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('user.orders.history') }}">
                                    <i class="fa-solid fa-box me-2"></i> Pesanan Saya
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>