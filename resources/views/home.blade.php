@extends('layouts.app')

@section('title', 'Home')

@push('styles')
<style>
  
    :root {
        --primary-bright: #ffb347;        /* warm sunrise orange */
        --primary-soft: #ffe5b4;           /* peachy cream */
        --secondary-sky: #a4d7e1;           /* fresh sky blue */
        --accent-melon: #fbc3b8;            /* soft coral */
        --bg-sunny: #fffbf5;                 /* creamy white background */
        --card-fresh: #ffffff;                /* pure white cards */
        --text-rich: #3a4f4b;                  /* deep forest for primary text */
        --text-soft: #6b7f7b;                    /* soft sage for secondary */
        --border-happy: #f3e1cf;                  /* warm border */
        --shadow-playful: 0 15px 30px rgba(255, 180, 70, 0.08), 0 8px 18px rgba(164, 215, 225, 0.1);
        --gradient-celebration: linear-gradient(135deg, #fde5c8 0%, #f9d8c6 50%, #e2f0f3 100%);
    }

    body {
        background-color: var(--bg-sunny);
    }

    /* hero — bright, sunny, uplifting */
    .hero-section {
        background: linear-gradient(135deg, #ffe0a8 0%, #ffd2b0 40%, #c7e5ec 100%);
        padding: 80px 0;
        border-radius: 0 0 60px 60px;
        margin-top: -24px;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-playful);
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.3" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,170.7C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
        background-repeat: no-repeat;
        background-position: bottom;
        background-size: cover;
        opacity: 0.2;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        color: #4d423b;          /* warm brownish tone */
    }

    .hero-title {
        font-size: 3.4rem;
        font-weight: 700;
        margin-bottom: 1rem;
        letter-spacing: -0.01em;
        color: #3f5c5c;            /* teal accent for contrast */
        text-shadow: 0 4px 8px rgba(255, 180, 70, 0.15);
        animation: fadeInUp 0.9s ease;
    }

    .hero-subtitle {
        font-size: 1.3rem;
        color: #5b6b68;
        margin-bottom: 2rem;
        animation: fadeInUp 0.9s ease 0.2s both;
    }

    .search-wrapper {
        animation: fadeInUp 0.9s ease 0.4s both;
    }

    .search-box {
        background: rgba(255, 255, 250, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid #ffd7b3;
        border-radius: 56px;
        padding: 4px;
        box-shadow: 0 8px 20px rgba(255, 180, 70, 0.1);
    }

    .search-box .form-control {
        background: transparent;
        border: none;
        color: #3a4f4b;
        font-size: 1.1rem;
        padding: 16px 26px;
    }

    .search-box .form-control::placeholder {
        color: #a7b8b5;
        font-weight: 350;
    }

    .search-box .form-control:focus {
        box-shadow: none;
        background: transparent;
        color: #3a4f4b;
    }

    .search-box .btn-search {
        background: #ffb347;        /* bright orange */
        color: #ffffff;
        border-radius: 56px;
        padding: 12px 38px;
        font-weight: 600;
        border: none;
        box-shadow: 0 6px 14px rgba(255, 180, 70, 0.3);
        transition: all 0.25s ease;
    }

    .search-box .btn-search:hover {
        background: #ffa42b;
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 15px 22px rgba(255, 150, 50, 0.25);
    }

    .section-title {
        position: relative;
        margin-bottom: 50px;
        text-align: center;
    }

    .section-title h2 {
        font-size: 2.5rem;
        font-weight: 600;
        color: #3f5c5c;
        display: inline-block;
        position: relative;
        padding-bottom: 15px;
        letter-spacing: -0.02em;
    }

    .section-title h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 90px;
        height: 4px;
        background: #ffb347;        /* bright orange underline */
        border-radius: 6px;
        opacity: 0.7;
    }

    .event-card {
        border: none;
        border-radius: 30px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.1, 0.7, 0.2, 1);
        box-shadow: 0 12px 26px -8px rgba(255, 160, 70, 0.12);
        height: 100%;
        position: relative;
        background: var(--card-fresh);
        border: 1px solid #f5e2cf;
    }

    .event-card:hover {
        transform: translateY(-10px) scale(1.01);
        box-shadow: 0 25px 35px -10px rgba(255, 140, 60, 0.2), 0 0 0 2px #ffe7ce inset;
        border-color: #ffcfaa;
    }

    .event-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #ffb347, #fccb7e, #a4d7e1);
        border-radius: 30px 30px 0 0;
    }

    .event-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #a4d7e1;        /* sky blue */
        color: #2b5858;
        padding: 6px 16px;
        border-radius: 40px;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 2;
        box-shadow: 0 4px 10px rgba(164, 215, 225, 0.3);
        backdrop-filter: blur(2px);
        border: 1px solid #b8e2ec;
    }

    .event-card .card-body {
        padding: 28px;
    }

    .event-title {
        font-size: 1.6rem;
        font-weight: 620;
        color: #375b5b;
        margin-bottom: 18px;
        transition: color 0.2s ease;
    }

    .event-card:hover .event-title {
        color: #ff8f4b;          /* vibrant orange on hover */
    }

    .event-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
        color: #5d7878;
        font-size: 0.98rem;
    }

    .event-info-item i {
        width: 28px;
        color: #ffb347;          /* cheerful orange icon */
        font-size: 1.2rem;
    }

    .event-description {
        color: #6b8484;
        line-height: 1.6;
        margin-bottom: 20px;
        font-size: 0.98rem;
        font-weight: 380;
    }

    .event-footer {
        background: transparent;
        border-top: 2px solid #ffe2cc;
        padding: 22px 28px;
    }

    .btn-view {
        background: #ffeed9;       /* soft peach */
        color: #3f6b6b;
        border: none;
        border-radius: 60px;
        padding: 14px 22px;
        font-weight: 600;
        width: 100%;
        transition: all 0.2s ease;
        border: 1px solid #ffdbb5;
        box-shadow: 0 6px 12px rgba(255, 190, 120, 0.1);
    }

    .btn-view:hover {
        background: #ffe2b5;
        color: #c45d2c;
        transform: translateY(-3px);
        border-color: #ffb886;
        box-shadow: 0 18px 24px -8px rgba(255, 140, 50, 0.2);
    }

    .btn-outline-view {
        background: transparent;
        border: 2px solid #ffb347;
        color: #3f6b6b;
        border-radius: 60px;
        padding: 15px 46px;
        font-weight: 600;
        transition: all 0.2s ease;
        backdrop-filter: blur(2px);
    }

    .btn-outline-view:hover {
        background: #ffb347;
        border-color: #ffb347;
        color: white !important;
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 18px 24px -8px rgba(255, 140, 50, 0.25);
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: #fff7ed;
        border-radius: 48px;
        border: 2px dashed #ffcfaa;
    }

    .empty-state i {
        font-size: 5rem;
        color: #ffb886;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #3f5c5c;
        font-weight: 550;
        margin-bottom: 8px;
    }

    .empty-state p {
        color: #6f9393;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .event-card {
        animation: fadeInUp 0.7s ease both;
    }

    .event-card:nth-child(1) { animation-delay: 0.02s; }
    .event-card:nth-child(2) { animation-delay: 0.07s; }
    .event-card:nth-child(3) { animation-delay: 0.12s; }
    .event-card:nth-child(4) { animation-delay: 0.17s; }
    .event-card:nth-child(5) { animation-delay: 0.22s; }
    .event-card:nth-child(6) { animation-delay: 0.27s; }

    @media (max-width: 768px) {
        .hero-title { font-size: 2.6rem; }
        .hero-section { padding: 60px 0; }
        .section-title h2 { font-size: 2.2rem; }
    }

    /* Stats section — fresh & happy */
    .stats-section {
        background: #feedd9;       /* warm creamy */
        padding: 50px 0;
        border-radius: 70px;
        margin: 50px 0;
        color: #3f5c5c;
        border: 2px solid #ffe0b7;
        box-shadow: var(--shadow-playful);
    }

    .stat-item {
        text-align: center;
        padding: 12px;
    }

    .stat-number {
        font-size: 2.6rem;
        font-weight: 650;
        margin-bottom: 5px;
        color: #c16f3c;            /* warm orange */
    }

    .stat-label {
        font-size: 1.1rem;
        color: #567575;
        font-weight: 470;
    }

    .featured-event {
        background: #fef5e9;       /* very light cream */
        border-radius: 50px;
        padding: 45px;
        margin: 50px 0;
        border: 2px solid #ffddb0;
        box-shadow: var(--shadow-playful);
    }

    /* category cards */
    .event-card.text-center {
        transition: all 0.25s;
        background: white;
        border: 1px solid #f7dbbf;
    }
    .event-card.text-center:hover i {
        transform: scale(1.1) rotate(2deg);
        color: #ffb347 !important;
    }

    /* all links, interactive elements: warm orange & sky */
    a, .btn-link, .btn-outline-view, .btn-search {
        transition: all 0.15s;
    }
    a:hover {
        color: #ffb347 !important;
    }

    /* extra fresh touches */
    .form-control, .btn, .card {
        -webkit-font-smoothing: antialiased;
    }

    .text-muted {
        color: #87a6a6 !important;
    }

    /* sunny decorations */
    .hero-title i, .section-title i {
        color: #ffb347;
        margin-right: 8px;
    }
</style>
@endpush

@section('content')
<!-- Hero Section — SUNNY & BRIGHT -->
<div class="hero-section mb-5">
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="hero-title"><i class="fas fa-sun"></i> Discover Amazing Events</h1>
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

<!-- Stats Section — warm & welcoming numbers -->
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
        <h2><i class="fas fa-calendar-star"></i> Upcoming Events</h2>
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
        <h2><i class="fas fa-icons"></i> Event Categories</h2>
        <p class="text-muted mt-3">Find events by category</p>
    </div>
    
    <div class="row">
        <div class="col-md-3 col-6 mb-4">
            <div class="event-card text-center p-4" style="cursor: pointer;" onclick="window.location.href='{{ route('events.index') }}?category=music'">
                <i class="fas fa-music fa-3x mb-3" style="color: #ffb347;"></i>
                <h5>Music</h5>
                <p class="text-muted small">Concerts & Festivals</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-4">
            <div class="event-card text-center p-4" style="cursor: pointer;" onclick="window.location.href='{{ route('events.index') }}?category=sports'">
                <i class="fas fa-futbol fa-3x mb-3" style="color: #ffb347;"></i>
                <h5>Sports</h5>
                <p class="text-muted small">Games & Tournaments</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-4">
            <div class="event-card text-center p-4" style="cursor: pointer;" onclick="window.location.href='{{ route('events.index') }}?category=arts'">
                <i class="fas fa-palette fa-3x mb-3" style="color: #ffb347;"></i>
                <h5>Arts</h5>
                <p class="text-muted small">Exhibitions & Theatre</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-4">
            <div class="event-card text-center p-4" style="cursor: pointer;" onclick="window.location.href='{{ route('events.index') }}?category=food'">
                <i class="fas fa-utensils fa-3x mb-3" style="color: #ffb347;"></i>
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
                <h3 class="mb-3" style="color: #3f5c5c;"><i class="fas fa-envelope-open-text" style="color: #ffb347;"></i> Never Miss an Event</h3>
                <p class="text-muted mb-4">Subscribe to our newsletter and get updates about upcoming events straight to your inbox.</p>
            </div>
            <div class="col-md-6">
                <form class="d-flex">
                    <input type="email" class="form-control form-control-lg me-2" placeholder="Enter your email" style="border-radius: 60px; border: 1px solid #ffdbb5; background: white; padding: 16px;">
                    <button class="btn-view" style="width: auto; padding: 12px 30px; background: #ffb347; color: white; border: none;">Subscribe</button>
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