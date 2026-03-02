@extends('layouts.app')

@section('title', 'Home')

@push('styles')
<style>
    /* ----------------------------------------------------
        REFRESHING & CLEAN color palette (light & airy)
    ---------------------------------------------------- */
    :root {
        --primary-light: #5f9ea0;        /* calm teal for primary */
        --primary-soft: #7fc9c9;          /* softer teal for gradients */
        --secondary-mint: #e0f2e9;        /* minty fresh background */
        --accent-sky: #b0e0e6;             /* powder blue for accents */
        --bg-offwhite: #fbfbf8;            /* warm off-white background */
        --card-white: #ffffff;              /* pure white cards */
        --text-soft: #2f4f4f;               /* dark slate for primary text */
        --text-light: #708090;               /* slate gray for secondary */
        --border-light: #e6edf0;             /* very light border */
        --shadow-sm: 0 8px 20px rgba(0, 40, 40, 0.04);
        --gradient-fresh: linear-gradient(145deg, #f0f9f5 0%, #e6f3f0 100%);
    }

    body {
        background-color: var(--bg-offwhite);
    }

    /* hero section — light, breezy, less heavy gradient */
    .hero-section {
        background: linear-gradient(125deg, #d4ede8 0%, #b8e0dd 50%, #c8e9e6 100%);
        padding: 80px 0;
        border-radius: 0 0 60px 60px;
        margin-top: -24px;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.25" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,170.7C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
        background-repeat: no-repeat;
        background-position: bottom;
        background-size: cover;
        opacity: 0.3;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        color: #1f4a4a;          /* deep teal for text */
    }

    .hero-title {
        font-size: 3.2rem;
        font-weight: 600;
        margin-bottom: 1rem;
        letter-spacing: -0.02em;
        color: #1f5f5f;
        text-shadow: 0 2px 4px rgba(95, 158, 160, 0.1);
        animation: fadeInUp 0.9s ease;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        color: #3b6b6b;
        margin-bottom: 2rem;
        animation: fadeInUp 0.9s ease 0.2s both;
    }

    .search-wrapper {
        animation: fadeInUp 0.9s ease 0.4s both;
    }

    .search-box {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(95, 158, 160, 0.25);
        border-radius: 56px;
        padding: 4px;
        box-shadow: 0 6px 14px rgba(95, 158, 160, 0.08);
    }

    .search-box .form-control {
        background: transparent;
        border: none;
        color: #1f4a4a;
        font-size: 1.1rem;
        padding: 16px 26px;
    }

    .search-box .form-control::placeholder {
        color: #7fa0a0;
        font-weight: 300;
    }

    .search-box .form-control:focus {
        box-shadow: none;
        background: transparent;
        color: #1f4a4a;
    }

    .search-box .btn-search {
        background: #ffffff;
        color: #5f9ea0;
        border-radius: 56px;
        padding: 12px 38px;
        font-weight: 500;
        border: none;
        box-shadow: 0 4px 8px rgba(95, 158, 160, 0.1);
        transition: all 0.2s ease;
    }

    .search-box .btn-search:hover {
        background: #f4fffc;
        transform: translateY(-2px);
        box-shadow: 0 10px 18px rgba(95, 158, 160, 0.15);
    }

    .section-title {
        position: relative;
        margin-bottom: 50px;
        text-align: center;
    }

    .section-title h2 {
        font-size: 2.3rem;
        font-weight: 500;
        color: #2f4f4f;
        display: inline-block;
        position: relative;
        padding-bottom: 12px;
        letter-spacing: -0.01em;
    }

    .section-title h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 70px;
        height: 3px;
        background: #a6d0d0;       /* soft teal underline */
        border-radius: 4px;
    }

    .event-card {
        border: none;
        border-radius: 28px;
        overflow: hidden;
        transition: all 0.25s ease;
        box-shadow: 0 6px 18px rgba(95, 158, 160, 0.06);
        height: 100%;
        position: relative;
        background: var(--card-white);
        border: 1px solid rgba(175, 200, 200, 0.3);
    }

    .event-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 28px -8px rgba(95, 158, 160, 0.15);
        border-color: #b8d8d8;
    }

    .event-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: #b2d8d8;       /* soft teal top edge */
        border-radius: 28px 28px 0 0;
    }

    .event-badge {
        position: absolute;
        top: 18px;
        right: 18px;
        background: #dff0f0;        /* very light teal */
        color: #3b7979;
        padding: 5px 15px;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 500;
        z-index: 2;
        box-shadow: 0 2px 6px rgba(95, 158, 160, 0.1);
        backdrop-filter: blur(2px);
        border: 1px solid #c5e0e0;
    }

    .event-card .card-body {
        padding: 26px;
    }

    .event-title {
        font-size: 1.5rem;
        font-weight: 550;
        color: #2f4f4f;
        margin-bottom: 16px;
        transition: color 0.2s ease;
    }

    .event-card:hover .event-title {
        color: #4f8a8a;          /* tealish on hover */
    }

    .event-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        color: #5b7e7e;
        font-size: 0.95rem;
    }

    .event-info-item i {
        width: 26px;
        color: #7fbbbb;          /* soft teal icon */
        font-size: 1.1rem;
    }

    .event-description {
        color: #668b8b;
        line-height: 1.6;
        margin-bottom: 20px;
        font-size: 0.95rem;
        font-weight: 350;
    }

    .event-footer {
        background: transparent;
        border-top: 1px solid #daecf0;
        padding: 20px 26px;
    }

    .btn-view {
        background: #e5f3f3;       /* very light teal */
        color: #3b6b6b;
        border: none;
        border-radius: 50px;
        padding: 12px 20px;
        font-weight: 500;
        width: 100%;
        transition: all 0.2s ease;
        border: 1px solid #b8d8d8;
        box-shadow: 0 2px 6px rgba(95,158,160,0.05);
    }

    .btn-view:hover {
        background: #d7eeee;
        color: #1f5f5f;
        transform: translateY(-2px);
        border-color: #7fbbbb;
        box-shadow: 0 10px 18px -6px rgba(95,158,160,0.2);
    }

    .btn-outline-view {
        background: transparent;
        border: 1.5px solid #b2d8d8;
        color: #3b6b6b;
        border-radius: 60px;
        padding: 14px 42px;
        font-weight: 500;
        transition: all 0.2s ease;
        backdrop-filter: blur(2px);
    }

    .btn-outline-view:hover {
        background: #f1fbfb;
        border-color: #7fbbbb;
        color: #1f5f5f;
        transform: translateY(-2px);
        box-shadow: 0 10px 18px -6px rgba(95,158,160,0.15);
    }

    .empty-state {
        text-align: center;
        padding: 70px 20px;
        background: #f3faf8;
        border-radius: 36px;
        border: 1px solid #daecf0;
    }

    .empty-state i {
        font-size: 5rem;
        color: #b2d8d8;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #2f4f4f;
        font-weight: 480;
        margin-bottom: 8px;
    }

    .empty-state p {
        color: #668b8b;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(25px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .event-card {
        animation: fadeInUp 0.6s ease both;
    }

    .event-card:nth-child(1) { animation-delay: 0.05s; }
    .event-card:nth-child(2) { animation-delay: 0.1s; }
    .event-card:nth-child(3) { animation-delay: 0.15s; }
    .event-card:nth-child(4) { animation-delay: 0.2s; }
    .event-card:nth-child(5) { animation-delay: 0.25s; }
    .event-card:nth-child(6) { animation-delay: 0.3s; }

    @media (max-width: 768px) {
        .hero-title { font-size: 2.5rem; }
        .hero-section { padding: 60px 0; }
        .section-title h2 { font-size: 2rem; }
    }

    /* Stats section — light glass */
    .stats-section {
        background: #dff0f0;       /* soft pastel teal */
        padding: 50px 0;
        border-radius: 56px;
        margin: 50px 0;
        color: #1f5f5f;
        border: 1px solid #b8d8d8;
        box-shadow: var(--shadow-sm);
    }

    .stat-item {
        text-align: center;
        padding: 10px;
    }

    .stat-number {
        font-size: 2.3rem;
        font-weight: 520;
        margin-bottom: 4px;
        color: #296868;
    }

    .stat-label {
        font-size: 1rem;
        color: #468282;
        font-weight: 400;
    }

    .featured-event {
        background: #f0f9f5;       /* very light mint */
        border-radius: 40px;
        padding: 40px;
        margin: 50px 0;
        border: 1px solid #c5e0e0;
        box-shadow: var(--shadow-sm);
    }

    /* category cards */
    .event-card.text-center {
        transition: all 0.2s;
        background: white;
    }
    .event-card.text-center:hover i {
        transform: scale(1.03);
        color: #5f9ea0 !important;
    }

    /* all links, interactive elements: friendly sky blue */
    a, .btn-link, .btn-outline-view, .btn-search {
        transition: all 0.15s;
    }
    a:hover {
        color: #5f9ea0 !important;
    }

    /* extra freshness */
    .form-control, .btn, .card {
        -webkit-font-smoothing: antialiased;
    }

    .text-muted {
        color: #7fa0a0 !important;
    }
</style>
@endpush

@section('content')
<!-- Hero Section — fresh & clean -->
<div class="hero-section mb-5">
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="hero-title">Discover Amazing Events</h1>
            <p class="hero-subtitle">Find and book tickets for the best events in your city</p>
            
            <!-- Search Form -->
            <div class="row justify-content-center search-wrapper">
                <div class="col-md-8">
                    <form action="{{ route('events.search') }}" method="GET" class="search-box">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Search events by name, location, or description..." 
                                   value="{{ request('search') }}">
                            <button class="btn btn-search" type="submit">
                                <i class="fas fa-search me-2"></i>Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section — light airy numbers -->
<div class="container">
    <div class="stats-section">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Events</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number">50K+</div>
                    <div class="stat-label">Happy Customers</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number">100+</div>
                    <div class="stat-label">Cities</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Support</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upcoming Events Section -->
<div class="container">
    <div class="section-title">
        <h2>Upcoming Events</h2>
        <p class="text-muted mt-3">Don't miss out on these amazing experiences</p>
    </div>
    
    @if($upcomingEvents->isNotEmpty())
        <div class="row">
            @foreach($upcomingEvents as $event)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="event-card">
                        @if($loop->first)
                            <div class="event-badge">
                                <i class="fas fa-star me-1"></i>Featured
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="event-title">{{ $event->event_name }}</h5>
                            <div class="event-info">
                                <div class="event-info-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>{{ \Carbon\Carbon::parse($event->eventDate)->format('l, F d, Y') }}</span>
                                </div>
                                <div class="event-info-item">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ \Carbon\Carbon::parse($event->eventTime)->format('h:i A') }}</span>
                                </div>
                                <div class="event-info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ Str::limit($event->location, 30) }}</span>
                                </div>
                                @if($event->tickets->isNotEmpty())
                                    <div class="event-info-item">
                                        <i class="fas fa-ticket-alt"></i>
                                        <span>From ${{ number_format($event->tickets->min('price'), 2) }}</span>
                                    </div>
                                @endif
                            </div>
                            <p class="event-description">{{ Str::limit($event->description, 100) }}</p>
                        </div>
                        <div class="event-footer">
                            <a href="{{ route('events.show', $event) }}" class="btn-view">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('events.index') }}" class="btn-outline-view">
                <i class="fas fa-calendar-alt me-2"></i>Browse All Events
            </a>
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-calendar-times"></i>
            <h3>No Upcoming Events</h3>
            <p>Check back later for new events or browse our past events</p>
            <a href="{{ route('events.index') }}" class="btn-view" style="width: auto; padding: 12px 40px;">
                <i class="fas fa-search me-2"></i>Browse Events
            </a>
        </div>
    @endif
</div>

<!-- Featured Categories -->
<div class="container mt-5">
    <div class="section-title">
        <h2>Event Categories</h2>
        <p class="text-muted mt-3">Find events by category</p>
    </div>
    
    <div class="row">
        <div class="col-md-3 col-6 mb-4">
            <div class="event-card text-center p-4" style="cursor: pointer;" onclick="window.location.href='{{ route('events.index') }}?category=music'">
                <i class="fas fa-music fa-3x mb-3" style="color: #7fbbbb;"></i>
                <h5>Music</h5>
                <p class="text-muted small">Concerts & Festivals</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-4">
            <div class="event-card text-center p-4" style="cursor: pointer;" onclick="window.location.href='{{ route('events.index') }}?category=sports'">
                <i class="fas fa-futbol fa-3x mb-3" style="color: #7fbbbb;"></i>
                <h5>Sports</h5>
                <p class="text-muted small">Games & Tournaments</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-4">
            <div class="event-card text-center p-4" style="cursor: pointer;" onclick="window.location.href='{{ route('events.index') }}?category=arts'">
                <i class="fas fa-palette fa-3x mb-3" style="color: #7fbbbb;"></i>
                <h5>Arts</h5>
                <p class="text-muted small">Exhibitions & Theatre</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-4">
            <div class="event-card text-center p-4" style="cursor: pointer;" onclick="window.location.href='{{ route('events.index') }}?category=food'">
                <i class="fas fa-utensils fa-3x mb-3" style="color: #7fbbbb;"></i>
                <h5>Food</h5>
                <p class="text-muted small">Festivals & Tastings</p>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter Section -->
<div class="container mt-5 mb-5">
    <div class="featured-event">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3 class="mb-3" style="color: #2f4f4f;">Never Miss an Event</h3>
                <p class="text-muted mb-4">Subscribe to our newsletter and get updates about upcoming events straight to your inbox.</p>
            </div>
            <div class="col-md-6">
                <form class="d-flex">
                    <input type="email" class="form-control form-control-lg me-2" placeholder="Enter your email" style="border-radius: 60px; border: 1px solid #b8d8d8; background: white;">
                    <button class="btn-view" style="width: auto; padding: 12px 30px;">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Add smooth scrolling animation
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    
    // Add animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.event-card, .stat-item, .featured-event').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease';
        observer.observe(el);
    });
</script>
@endpush