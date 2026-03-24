<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'TicketHub')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts: Clash Display + DM Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">

    <style>
        /* ─── DESIGN TOKENS ─────────────────────────────────── */
        :root {
            --ink:      #0a0a0f;
            --ink-2:    #1c1c28;
            --ink-3:    #2e2e42;
            --surface:  #f5f4f0;
            --surface-2:#eceae3;
            --accent:   #e8ff47;       /* electric lime */
            --accent-2: #ff4d6d;       /* vivid rose */
            --muted:    #9998b0;
            --white:    #ffffff;

            --r-sm:  6px;
            --r-md:  14px;
            --r-lg:  24px;
            --r-xl:  40px;

            --ease-out: cubic-bezier(0.22, 1, 0.36, 1);
            --ease-spring: cubic-bezier(0.34, 1.56, 0.64, 1);

            --font-display: 'Syne', sans-serif;
            --font-body:    'DM Sans', sans-serif;

            --nav-h: 68px;
        }

        /* ─── RESET & BASE ──────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font-body);
            background: var(--surface);
            color: var(--ink);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        main { flex: 1; padding-top: var(--nav-h); }

        a { color: inherit; text-decoration: none; }

        /* ─── GRAIN OVERLAY ─────────────────────────────────── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='1'/%3E%3C/svg%3E");
            opacity: 0.025;
            pointer-events: none;
            z-index: 9999;
        }

        /* ─── NAVBAR ────────────────────────────────────────── */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            height: var(--nav-h);
            background: rgba(10, 10, 15, 0.92);
            backdrop-filter: blur(18px) saturate(160%);
            -webkit-backdrop-filter: blur(18px) saturate(160%);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            padding: 0;
            display: flex;
            align-items: center;
        }

        .navbar .container {
            display: flex;
            align-items: center;
            width: 100%;
            min-width: 0;
        }

        /* Brand */
        .brand {
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: var(--font-display);
            font-weight: 800;
            font-size: 1.45rem;
            letter-spacing: -0.02em;
            color: var(--white);
            transition: opacity .2s;
            min-width: 0;
        }

        .brand:hover { opacity: .8; }

        .brand-icon {
            width: 34px; height: 34px;
            background: var(--accent);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: var(--ink);
            font-size: 1rem;
            flex-shrink: 0;
        }

        /* Nav links */
        .navbar-nav { gap: 2px; }

        .nav-link {
            font-family: var(--font-body);
            font-size: 0.875rem;
            font-weight: 500;
            color: rgba(255,255,255,0.6) !important;
            padding: 6px 14px !important;
            border-radius: 8px;
            transition: color .2s, background .2s;
            letter-spacing: 0.01em;
        }

        .nav-link:hover {
            color: var(--white) !important;
            background: rgba(255,255,255,0.07);
        }

        .nav-link.active {
            color: var(--white) !important;
            background: rgba(255,255,255,0.1);
        }

        /* Cart button */
        .cart-btn {
            position: relative;
            width: 38px; height: 38px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 10px;
            background: rgba(255,255,255,0.06);
            color: rgba(255,255,255,0.75);
            font-size: 1rem;
            transition: background .2s, color .2s, transform .2s var(--ease-spring);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .cart-btn:hover {
            background: rgba(255,255,255,0.13);
            color: var(--white);
            transform: scale(1.07);
        }

        .cart-badge {
            position: absolute;
            top: -5px; right: -5px;
            background: var(--accent-2);
            color: var(--white);
            font-size: 0.6rem;
            font-weight: 700;
            min-width: 17px; height: 17px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 99px;
            padding: 0 4px;
            border: 2px solid var(--ink);
        }

        /* Auth buttons */
        .btn-nav-outline {
            font-family: var(--font-body);
            font-size: 0.875rem;
            font-weight: 500;
            padding: 7px 18px;
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.75);
            background: transparent;
            transition: border-color .2s, color .2s, background .2s;
        }

        .btn-nav-outline:hover {
            border-color: rgba(255,255,255,0.5);
            color: var(--white);
            background: rgba(255,255,255,0.05);
        }

        .btn-nav-solid {
            font-family: var(--font-body);
            font-size: 0.875rem;
            font-weight: 600;
            padding: 7px 18px;
            border-radius: 8px;
            border: none;
            color: var(--ink);
            background: var(--accent);
            transition: opacity .2s, transform .2s var(--ease-spring);
        }

        .btn-nav-solid:hover {
            opacity: .88;
            transform: translateY(-1px);
            color: var(--ink);
        }

        /* User dropdown */
        .user-pill {
            display: flex; align-items: center; gap: 8px;
            padding: 6px 12px 6px 8px;
            border-radius: 99px;
            border: 1px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.05);
            color: var(--white);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background .2s, border-color .2s;
            max-width: 240px;
        }

        .user-pill:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.22);
        }

        .user-avatar {
            width: 28px; height: 28px;
            border-radius: 50%;
            background: var(--accent);
            color: var(--ink);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.75rem;
            font-weight: 800;
            font-family: var(--font-display);
            flex-shrink: 0;
        }

        .dropdown-menu {
            background: var(--ink-2);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: var(--r-md);
            padding: 6px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            min-width: 200px;
            margin-top: 8px !important;
        }

        .user-pill > span:last-of-type {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dropdown-item {
            font-family: var(--font-body);
            font-size: 0.875rem;
            font-weight: 400;
            color: rgba(255,255,255,0.7);
            padding: 9px 14px;
            border-radius: 8px;
            display: flex; align-items: center; gap: 10px;
            transition: background .15s, color .15s;
        }

        .dropdown-item i { font-size: 0.8rem; opacity: .6; }

        .dropdown-item:hover {
            background: rgba(255,255,255,0.08);
            color: var(--white);
        }

        .dropdown-item:hover i { opacity: 1; }

        .dropdown-divider {
            border-color: rgba(255,255,255,0.07);
            margin: 4px 0;
        }

        .dropdown-item.danger { color: var(--accent-2); }
        .dropdown-item.danger:hover { background: rgba(255,77,109,0.15); }

        /* Toggler */
        .navbar-toggler {
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 8px;
            padding: 6px 10px;
        }

        .navbar-toggler:focus { box-shadow: none; }
        .navbar-toggler-icon { width: 18px; height: 18px; }

        /* ─── ALERTS ────────────────────────────────────────── */
        .alert-wrapper {
            position: fixed;
            top: calc(var(--nav-h) + 16px);
            right: 20px;
            z-index: 990;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 360px;
            width: 100%;
        }

        .alert {
            background: var(--ink-2);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: var(--r-md);
            color: var(--white);
            font-family: var(--font-body);
            font-size: 0.875rem;
            padding: 14px 16px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
            display: flex; align-items: flex-start; gap: 12px;
            animation: slideInAlert .35s var(--ease-out) both;
        }

        @keyframes slideInAlert {
            from { opacity: 0; transform: translateX(30px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .alert-icon {
            width: 28px; height: 28px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .alert-success .alert-icon { background: rgba(74, 222, 128, 0.15); color: #4ade80; }
        .alert-danger  .alert-icon { background: rgba(255, 77, 109, 0.15); color: var(--accent-2); }

        .alert .btn-close {
            margin-left: auto;
            filter: invert(1);
            opacity: .4;
            width: 0.7em; height: 0.7em;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .alert .btn-close:hover { opacity: .8; }

        /* ─── MAIN CONTENT ──────────────────────────────────── */
        .page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: clamp(24px, 3vw, 40px) clamp(14px, 2.4vw, 24px) clamp(40px, 6vw, 60px);
            width: 100%;
        }

        /* ─── FOOTER ────────────────────────────────────────── */
        footer {
            background: var(--ink);
            color: var(--white);
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        /* Guest full footer */
        .footer-full { padding: 64px 0 0; }

        .footer-brand {
            font-family: var(--font-display);
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.02em;
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 18px;
        }

        .footer-brand-icon {
            width: 36px; height: 36px;
            background: var(--accent);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            color: var(--ink);
            font-size: 1rem;
        }

        .footer-desc {
            color: var(--muted);
            font-size: 0.9rem;
            line-height: 1.7;
            max-width: 280px;
            margin-bottom: 28px;
        }

        .social-links {
            display: flex; gap: 10px;
        }

        .social-link {
            width: 36px; height: 36px;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.1);
            display: flex; align-items: center; justify-content: center;
            color: var(--muted);
            font-size: 0.85rem;
            transition: background .2s, color .2s, border-color .2s, transform .2s var(--ease-spring);
        }

        .social-link:hover {
            background: var(--accent);
            color: var(--ink);
            border-color: var(--accent);
            transform: translateY(-3px);
        }

        .footer-col-label {
            font-family: var(--font-display);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 20px;
        }

        .footer-links { list-style: none; display: flex; flex-direction: column; gap: 12px; }

        .footer-links a {
            color: rgba(255,255,255,0.55);
            font-size: 0.9rem;
            transition: color .2s, padding-left .2s;
            display: flex; align-items: center; gap: 8px;
        }

        .footer-links a:hover { color: var(--white); padding-left: 4px; }

        .footer-links a i { font-size: 0.7rem; color: var(--accent); opacity: 0; transition: opacity .2s; }

        .footer-links a:hover i { opacity: 1; }

        .contact-item {
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 14px;
        }

        .contact-item-icon {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: rgba(255,255,255,0.05);
            display: flex; align-items: center; justify-content: center;
            color: var(--accent);
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .contact-item span {
            color: rgba(255,255,255,0.55);
            font-size: 0.875rem;
        }

        .footer-bar {
            margin-top: 48px;
            border-top: 1px solid rgba(255,255,255,0.06);
            padding: 20px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer-bar p {
            color: var(--muted);
            font-size: 0.82rem;
        }

        .footer-bar-links { display: flex; gap: 20px; }

        .footer-bar-links a {
            color: var(--muted);
            font-size: 0.82rem;
            transition: color .2s;
        }

        .footer-bar-links a:hover { color: var(--white); }

        /* ─── MINIMIZED FOOTER ──────────────────────────────── */
        .footer-min {
            padding: 24px 0;
        }

        .footer-min-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .footer-min-brand {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 1rem;
            display: flex; align-items: center; gap: 7px;
            color: rgba(255,255,255,0.5);
        }

        .footer-min-brand-dot {
            width: 20px; height: 20px;
            background: var(--accent);
            border-radius: 5px;
            display: flex; align-items: center; justify-content: center;
            color: var(--ink);
            font-size: 0.65rem;
        }

        .footer-min-links {
            display: flex; gap: 6px;
            flex-wrap: wrap;
        }

        .footer-min-link {
            font-size: 0.82rem;
            font-weight: 500;
            color: rgba(255,255,255,0.4);
            padding: 5px 12px;
            border-radius: 6px;
            transition: background .2s, color .2s;
            display: flex; align-items: center; gap: 6px;
        }

        .footer-min-link i { font-size: 0.7rem; }

        .footer-min-link:hover {
            background: rgba(255,255,255,0.06);
            color: rgba(255,255,255,0.8);
        }

        .footer-min-copy {
            color: rgba(255,255,255,0.25);
            font-size: 0.78rem;
        }

        /* ─── RESPONSIVE ────────────────────────────────────── */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: rgba(10,10,15,0.97);
                border-top: 1px solid rgba(255,255,255,0.06);
                padding: 16px 0 20px;
                margin-top: 10px;
                border-radius: 0 0 16px 16px;
            }

            .navbar .container {
                padding-left: 14px;
                padding-right: 14px;
            }

            .brand {
                font-size: 1.2rem;
                gap: 6px;
            }

            .brand-icon {
                width: 30px;
                height: 30px;
            }

            .nav-end-group {
                margin-top: 12px;
                padding-top: 12px;
                border-top: 1px solid rgba(255,255,255,0.06);
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
                width: 100%;
            }

            .nav-end-group > * {
                width: 100%;
            }

            .user-pill {
                max-width: none;
                width: 100%;
                justify-content: flex-start;
            }

            .cart-btn {
                width: 44px;
                height: 44px;
            }

            .footer-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            .footer-min-inner {
                flex-direction: column;
                align-items: flex-start;
            }

            .alert-wrapper {
                right: 14px;
                left: 14px;
                max-width: none;
                width: auto;
            }
        }

        @media (max-width: 575px) {
            .btn-nav-outline,
            .btn-nav-solid,
            .nav-end-group .nav-link {
                width: 100%;
                text-align: center;
                justify-content: center;
                display: inline-flex;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- ── NAVBAR ──────────────────────────────────────────── --}}
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">

            <a class="brand" href="{{ route('home') }}">
                <span class="brand-icon">
                    <i class="bi bi-ticket-perforated-fill"></i>
                </span>
                TicketHub
            </a>

            <button class="navbar-toggler ms-auto me-2" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('events.*') ? 'active' : '' }}"
                           href="{{ route('events.index') }}">
                            Events
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2 nav-end-group">

                    @guest

                        <a href="{{ route('login') }}"
                           class="btn-nav-outline">Sign in</a>

                        <a href="{{ route('register') }}"
                           class="btn-nav-solid">Get started</a>

                    @else

                        {{-- Cart --}}
                        <a href="{{ route('cart.index') }}" class="cart-btn">
                            <i class="bi bi-bag"></i>
                            @if(session()->has('cart') && count(session('cart')) > 0)
                                <span class="cart-badge">{{ count(session('cart')) }}</span>
                            @endif
                        </a>

                        {{-- Orders --}}
                        <a href="{{ route('orders.index') }}"
                           class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                           Orders
                        </a>

                        {{-- User Dropdown --}}
                        <div class="dropdown">
                            <div class="user-pill" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="user-avatar">
                                    {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}
                                </span>
                                <span>{{ Auth::user()->first_name }}</span>
                                <i class="bi bi-chevron-down" style="font-size:.65rem; opacity:.5;"></i>
                            </div>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person"></i> Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('orders.index') }}">
                                        <i class="bi bi-box"></i> My Orders
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item danger w-100 text-start">
                                            <i class="bi bi-box-arrow-right"></i> Sign out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    @endguest

                </div>
            </div>
        </div>
    </nav>

    {{-- ── FLOATING ALERTS ─────────────────────────────────── --}}
    @if(session('success') || session('error'))
        <div class="alert-wrapper">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-icon">
                        <i class="bi bi-check-lg"></i>
                    </span>
                    <div style="flex:1;">
                        <div style="font-weight:500; margin-bottom:2px;">Success</div>
                        <div style="color:rgba(255,255,255,.6); font-size:.82rem;">{{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-icon">
                        <i class="bi bi-exclamation-lg"></i>
                    </span>
                    <div style="flex:1;">
                        <div style="font-weight:500; margin-bottom:2px;">Error</div>
                        <div style="color:rgba(255,255,255,.6); font-size:.82rem;">{{ session('error') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
    @endif

    {{-- ── MAIN ─────────────────────────────────────────────── --}}
    <main>
        <div class="page-container">
            @yield('content')
        </div>
    </main>

    {{-- ── FOOTER ───────────────────────────────────────────── --}}
    @guest
        <footer>
            <div class="footer-full">
                <div class="container">
                    <div class="row g-5">

                        {{-- Brand col --}}
                        <div class="col-lg-4">
                            <div class="footer-brand">
                                <span class="footer-brand-icon">
                                    <i class="bi bi-ticket-perforated-fill"></i>
                                </span>
                                TicketHub
                            </div>
                            <p class="footer-desc">
                                Your premier destination for discovering and booking unforgettable events — concerts, sports, theatre, and more.
                            </p>
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-x-twitter"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>

                        {{-- Quick Links --}}
                        <div class="col-6 col-lg-2">
                            <div class="footer-col-label">Navigate</div>
                            <ul class="footer-links">
                                <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i> Home</a></li>
                                <li><a href="{{ route('events.index') }}"><i class="fas fa-chevron-right"></i> Events</a></li>
                                <li><a href="{{ route('login') }}"><i class="fas fa-chevron-right"></i> Sign In</a></li>
                                <li><a href="{{ route('register') }}"><i class="fas fa-chevron-right"></i> Register</a></li>
                            </ul>
                        </div>

                        {{-- Support --}}
                        <div class="col-6 col-lg-2">
                            <div class="footer-col-label">Support</div>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fas fa-chevron-right"></i> FAQ</a></li>
                                <li><a href="#"><i class="fas fa-chevron-right"></i> Contact</a></li>
                                <li><a href="#"><i class="fas fa-chevron-right"></i> Terms</a></li>
                                <li><a href="#"><i class="fas fa-chevron-right"></i> Privacy</a></li>
                            </ul>
                        </div>

                        {{-- Contact --}}
                        <div class="col-lg-4">
                            <div class="footer-col-label">Contact</div>
                            <div class="contact-item">
                                <span class="contact-item-icon"><i class="fas fa-envelope"></i></span>
                                <span>support@tickethub.com</span>
                            </div>
                            <div class="contact-item">
                                <span class="contact-item-icon"><i class="fas fa-phone"></i></span>
                                <span>+1 (234) 567-890</span>
                            </div>
                            <div class="contact-item">
                                <span class="contact-item-icon"><i class="fas fa-location-dot"></i></span>
                                <span>123 Event Street, City</span>
                            </div>
                        </div>

                    </div>

                    <div class="footer-bar">
                        <p>&copy; {{ date('Y') }} TicketHub. All rights reserved.</p>
                        <div class="footer-bar-links">
                            <a href="#">Privacy</a>
                            <a href="#">Terms</a>
                            <a href="#">Cookies</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    @else

        <footer>
            <div class="container footer-min">
                <div class="footer-min-inner">
                    <div class="footer-min-brand">
                        <span class="footer-min-brand-dot">
                            <i class="bi bi-ticket-perforated-fill"></i>
                        </span>
                        TicketHub
                    </div>

                    <div class="footer-min-links">
                        <a href="{{ route('home') }}" class="footer-min-link">
                            <i class="bi bi-house"></i> Home
                        </a>
                        <a href="{{ route('events.index') }}" class="footer-min-link">
                            <i class="bi bi-calendar3"></i> Events
                        </a>
                        <a href="{{ route('orders.index') }}" class="footer-min-link">
                            <i class="bi bi-box"></i> Orders
                        </a>
                        <a href="{{ route('profile.edit') }}" class="footer-min-link">
                            <i class="bi bi-person"></i> Profile
                        </a>
                        <a href="#" class="footer-min-link">
                            <i class="bi bi-question-circle"></i> Help
                        </a>
                    </div>

                    <span class="footer-min-copy">&copy; {{ date('Y') }} TicketHub</span>
                </div>
            </div>
        </footer>

    @endguest

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @stack('scripts')

</body>

</html>