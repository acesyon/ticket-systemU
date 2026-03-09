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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">      
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
        
        <style>
            .navbar {
                padding: 1rem 0;
                box-shadow: 0 2px 4px rgba(0,0,0,.1);
            }
            
            .brand { font-weight: 800; font-size: 1.6rem; color: #fff; text-decoration: none; }
        .brand span { color: #e94560; }
            
            .nav-link {
                font-size: 1.1rem;
                padding: 0.5rem 1rem !important;
                transition: color 0.3s ease;
            }
            
            .nav-link:hover {
                color: #fff !important;
                opacity: 0.9;
            }
            
            .cart-badge {
                position: absolute;
                top: -8px;
                right: -8px;
                font-size: 0.7rem;
                padding: 0.25rem 0.5rem;
                background-color: #dc3545;
                color: white;
                border-radius: 50%;
                min-width: 20px;
                height: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
            }
            
            .navbar-nav .nav-item {
                margin: 0 0.25rem;
            }
            
            .dropdown-menu {
                font-size: 1rem;
                border: none;
                box-shadow: 0 4px 6px rgba(0,0,0,.1);
                padding: 0.5rem 0;
            }
            
            .dropdown-item {
                padding: 0.6rem 1.5rem;
                font-size: 1rem;
            }
            
            .dropdown-item:hover {
                background-color: #f8f9fa;
            }
            
            .cart-icon {
                font-size: 1.2rem;
            }
            
            @media (max-width: 991.98px) {
                .navbar-nav .nav-item {
                    margin: 0.25rem 0;
                }
                
                .cart-badge {
                    top: 50%;
                    transform: translateY(-50%);
                    right: 1rem;
                }
                
                .position-relative {
                    display: inline-block;
                }
            }
        </style>
        
        @stack('styles')
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="brand" href="{{ route('home') }}">
                    <i class="bi bi-ticket-detailed me-1"></i>
                    TicketHub
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('events.*') ? 'active' : '' }}" href="{{ route('events.index') }}">
                                <i class="fas fa-calendar-alt me-1"></i>Events
                            </a>
                        </li>
                    </ul>
                    
                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i>Login
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus me-1"></i>Register
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
                                <a class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                                    <i class="fas fa-box me-1"></i>Orders
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle me-2" style="font-size: 1.3rem;"></i>
                                    <span>{{ Auth::user()->first_name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                            <i class="fas fa-user-edit me-2"></i>Profile
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt me-2"></i>Logout
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
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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