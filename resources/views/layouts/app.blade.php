<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Ticketing System')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        /* NAVBAR */
        .navbar {
            padding: 0.8rem 0;
            background: #111 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* BRAND */
        .brand {
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: white;
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .brand i {
            font-size: 1.4rem;
            color: #ffc107;
        }

        /* NAV LINKS */
        .nav-link {
            font-size: 1rem;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            color: #ddd !important;
            transition: all .25s ease;
            border-radius: 6px;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #fff !important;
        }

        .nav-link.active {
            color: #ffc107 !important;
        }

        /* CART ICON */
        .cart-icon {
            font-size: 1.25rem;
        }

        /* CART BADGE */
        .cart-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background: #ff3b30;
            color: white;
            font-size: 0.65rem;
            font-weight: 600;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        /* DROPDOWN */
        .dropdown-menu {
            border: none;
            border-radius: 10px;
            padding: 8px 0;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            padding: 10px 20px;
            font-size: 0.95rem;
        }

        .dropdown-item:hover {
            background: #f1f1f1;
        }

        /* ALERTS */
        .alert {
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
        }

        /* MOBILE */
        @media (max-width: 991px) {
            .navbar-nav {
                margin-top: 10px;
            }

            .nav-link {
                padding: 0.6rem 0.5rem !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">

            <!-- CLICKABLE TICKETHUB -->
            <a class="brand text-white text-decoration-none" href="{{ route('home') }}">
                <i class="bi bi-ticket-detailed me-1"></i>
                TicketHub
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('events.*') ? 'active' : '' }}"
                            href="{{ route('events.index') }}">
                            <i class="fas fa-calendar-alt me-1"></i>
                            Events
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto align-items-center">

                    @guest

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                                href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>
                                Login
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}"
                                href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i>
                                Register
                            </a>
                        </li>

                    @else

                        <li class="nav-item">
                            <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart cart-icon"></i>

                                @if(session()->has('cart') && count(session('cart')) > 0)
                                    <span class="cart-badge">
                                        {{ count(session('cart')) }}
                                    </span>
                                @endif
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}"
                                href="{{ route('orders.index') }}">
                                <i class="fas fa-box me-1"></i>
                                Orders
                            </a>
                        </li>

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle d-flex align-items-center"
                                href="#"
                                id="userDropdown"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">

                                <i class="fas fa-user-circle me-2" style="font-size:1.3rem;"></i>
                                <span>{{ Auth::user()->first_name }}</span>

                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">

                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user-edit me-2"></i>
                                        Profile
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i>
                                            Logout
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

    <main class="py-4">
        <div class="container">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close"
                        data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close"
                        data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')

        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @stack('scripts')

</body>

</html>