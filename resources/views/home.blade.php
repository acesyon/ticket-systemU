@extends('layouts.app')

@section('title', 'Home')

@push('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .hero-section {
        background: var(--primary-gradient);
        padding: 80px 0;
        border-radius: 0 0 50px 50px;
        margin-top: -24px;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,170.7C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
        background-repeat: no-repeat;
        background-position: bottom;
        background-size: cover;
        opacity: 0.5;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        color: white;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        animation: fadeInUp 1s ease;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        opacity: 0.95;
        margin-bottom: 2rem;
        animation: fadeInUp 1s ease 0.2s both;
    }

    .search-wrapper {
        animation: fadeInUp 1s ease 0.4s both;
    }

    .search-box {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 50px;
        padding: 5px;
    }

    .search-box .form-control {
        background: transparent;
        border: none;
        color: white;
        font-size: 1.1rem;
        padding: 15px 25px;
    }

    .search-box .form-control::placeholder {
        color: rgba(255,255,255,0.7);
    }

    .search-box .form-control:focus {
        box-shadow: none;
        background: transparent;
        color: white;
    }

    .search-box .btn-search {
        background: white;
        color: #667eea;
        border-radius: 50px;
        padding: 12px 35px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .search-box .btn-search:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    .section-title {
        position: relative;
        margin-bottom: 50px;
        text-align: center;
    }

    .section-title h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        display: inline-block;
        position: relative;
        padding-bottom: 15px;
    }

    .section-title h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }

    .event-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        height: 100%;
        position: relative;
    }

    .event-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
    }

    .event-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: var(--primary-gradient);
    }

    .event-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--secondary-gradient);
        color: white;
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 2;
        box-shadow: 0 5px 15px rgba(245, 87, 108, 0.3);
    }

    .event-card .card-body {
        padding: 25px;
    }

    .event-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
        transition: color 0.3s ease;
    }

    .event-card:hover .event-title {
        color: #667eea;
    }

    .event-info {
        margin-bottom: 15px;
    }

    .event-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        color: #666;
    }

    .event-info-item i {
        width: 25px;
        color: #667eea;
        font-size: 1.1rem;
    }

    .event-description {
        color: #777;
        line-height: 1.6;
        margin-bottom: 20px;
        font-size: 0.95rem;
    }

    .event-footer {
        background: transparent;
        border-top: 1px solid rgba(102, 126, 234, 0.1);
        padding: 20px 25px;
    }

    .btn-view {
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 25px;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-view::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        color: white;
    }

    .btn-view:hover::before {
        left: 100%;
    }

    .btn-outline-view {
        background: transparent;
        border: 2px solid #667eea;
        color: #667eea;
        border-radius: 50px;
        padding: 15px 40px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-view:hover {
        background: var(--primary-gradient);
        border-color: transparent;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: #f8f9fa;
        border-radius: 20px;
    }

    .empty-state i {
        font-size: 5rem;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #333;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #666;
        margin-bottom: 20px;
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

    /* Floating animation for cards */
    .event-card {
        animation: fadeInUp 0.6s ease both;
    }

    /* Individual animation delays - fixed for up to 6 cards */
    .event-card:nth-child(1) { animation-delay: 0.1s; }
    .event-card:nth-child(2) { animation-delay: 0.2s; }
    .event-card:nth-child(3) { animation-delay: 0.3s; }
    .event-card:nth-child(4) { animation-delay: 0.4s; }
    .event-card:nth-child(5) { animation-delay: 0.5s; }
    .event-card:nth-child(6) { animation-delay: 0.6s; }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-section {
            padding: 60px 0;
        }
        
        .section-title h2 {
            font-size: 2rem;
        }
    }

    /* Stats section */
    .stats-section {
        background: var(--primary-gradient);
        padding: 60px 0;
        border-radius: 50px;
        margin: 50px 0;
        color: white;
    }

    .stat-item {
        text-align: center;
        padding: 20px;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    /* Featured event */
    .featured-event {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border-radius: 30px;
        padding: 40px;
        margin: 50px 0;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
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

<!-- Stats Section -->
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
                <i class="fas fa-music fa-3x mb-3" style="color: #667eea;"></i>
                <h5>Music</h5>
                <p class="text-muted small">Concerts & Festivals</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-4">
            <div class="event-card text-center p-4" style="cursor: pointer;" onclick="window.location.href='{{ route('events.index') }}?category=sports'">
                <i class="fas fa-futbol fa-3x mb-3" style="color: #667eea;"></i>
                <h5>Sports</h5>
                <p class="text-muted small">Games & Tournaments</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-4">
            <div class="event-card text-center p-4" style="cursor: pointer;" onclick="window.location.href='{{ route('events.index') }}?category=arts'">
                <i class="fas fa-palette fa-3x mb-3" style="color: #667eea;"></i>
                <h5>Arts</h5>
                <p class="text-muted small">Exhibitions & Theatre</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-4">
            <div class="event-card text-center p-4" style="cursor: pointer;" onclick="window.location.href='{{ route('events.index') }}?category=food'">
                <i class="fas fa-utensils fa-3x mb-3" style="color: #667eea;"></i>
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
                <h3 class="mb-3">Never Miss an Event</h3>
                <p class="text-muted mb-4">Subscribe to our newsletter and get updates about upcoming events straight to your inbox.</p>
            </div>
            <div class="col-md-6">
                <form class="d-flex">
                    <input type="email" class="form-control form-control-lg me-2" placeholder="Enter your email">
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