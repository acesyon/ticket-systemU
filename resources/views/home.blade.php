@extends('layouts.app')

@section('title', 'Home')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --white: #ffffff;
        --off-white: #fafafa;
        --light-gray: #f5f5f5;
        --border: #eaeaea;
        --text-primary: #1a1a1a;
        --text-secondary: #666666;
        --text-tertiary: #999999;
        --accent: #2563eb;
        --accent-light: #3b82f6;
        --accent-soft: #dbeafe;
        --success: #10b981;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.02), 0 1px 2px rgba(0,0,0,0.02);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.01);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.02), 0 4px 6px -2px rgba(0,0,0,0.01);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: var(--white);
        color: var(--text-primary);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        line-height: 1.5;
        -webkit-font-smoothing: antialiased;
    }

    .container-custom {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 32px;
    }

    /* Typography */
    h1, h2, h3, h4, h5, h6 {
        font-weight: 600;
        letter-spacing: -0.02em;
        color: var(--text-primary);
    }

    .text-gradient {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Hero Section */
    .hero-section {
        padding: 80px 0 40px;
        background: linear-gradient(to bottom, var(--white), var(--off-white));
    }

    .hero-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }

    .hero-content {
        max-width: 560px;
    }

    .hero-eyebrow {
        display: inline-block;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--accent);
        background: var(--accent-soft);
        padding: 6px 14px;
        border-radius: 100px;
        margin-bottom: 24px;
    }

    .hero-title {
        font-size: clamp(40px, 5vw, 64px);
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 24px;
        color: var(--text-primary);
    }

    .hero-subtitle {
        font-size: 18px;
        color: var(--text-secondary);
        margin-bottom: 32px;
        line-height: 1.6;
    }

    /* Search Bar */
    .search-container {
        background: var(--white);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border);
        padding: 8px;
        display: flex;
        align-items: center;
    }

    .search-input {
        flex: 1;
        border: none;
        padding: 16px 20px;
        font-size: 16px;
        color: var(--text-primary);
        background: transparent;
        outline: none;
    }

    .search-input::placeholder {
        color: var(--text-tertiary);
    }

    .search-btn {
        background: var(--accent);
        color: white;
        border: none;
        padding: 14px 32px;
        border-radius: var(--radius-sm);
        font-weight: 500;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.2s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .search-btn:hover {
        background: var(--accent-light);
    }

    /* Hero Stats */
    .hero-stats {
        display: flex;
        gap: 48px;
        margin-top: 48px;
    }

    .hero-stat {
        display: flex;
        flex-direction: column;
    }

    .hero-stat-num {
        font-size: 32px;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1.2;
    }

    .hero-stat-label {
        font-size: 14px;
        color: var(--text-tertiary);
        font-weight: 400;
    }

    /* Hero Image */
    .hero-image {
        position: relative;
    }

    .hero-image-bg {
        position: relative;
        background: linear-gradient(135deg, var(--accent-soft) 0%, var(--off-white) 100%);
        border-radius: var(--radius-lg);
        padding: 40px;
    }

    .hero-image-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .hero-image-item {
        background: rgba(255,255,255,0.5);
        backdrop-filter: blur(5px);
        padding: 24px;
        border-radius: var(--radius-md);
        border: 1px solid rgba(255,255,255,0.8);
    }

    .hero-image-item i {
        font-size: 24px;
        color: var(--accent);
        margin-bottom: 12px;
    }

    .hero-image-item span {
        font-size: 14px;
        font-weight: 500;
        color: var(--text-secondary);
    }

    /* Section Headers */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 48px;
    }

    .section-header-left h2 {
        font-size: 32px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .section-header-left p {
        font-size: 16px;
        color: var(--text-secondary);
    }

    .section-link {
        color: var(--accent);
        text-decoration: none;
        font-weight: 500;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 0;
        border-bottom: 2px solid transparent;
        transition: border-color 0.2s;
    }

    .section-link:hover {
        border-bottom-color: var(--accent);
    }

    /* Events Grid */
    .events-section {
        padding: 80px 0;
        background: var(--white);
    }

    .events-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .event-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 24px;
        transition: all 0.2s;
        position: relative;
    }

    .event-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
    }

    .event-card.featured {
        grid-column: span 2;
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 32px;
        padding: 32px;
    }

    .event-badge {
        display: inline-block;
        background: var(--accent-soft);
        color: var(--accent);
        font-size: 12px;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 100px;
        margin-bottom: 16px;
    }

    .event-badge.new {
        background: var(--success);
        color: white;
    }

    .event-title {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 12px;
        line-height: 1.3;
    }

    .featured .event-title {
        font-size: 28px;
    }

    .event-meta {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 16px;
    }

    .event-meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--text-secondary);
        font-size: 14px;
    }

    .event-meta-item i {
        color: var(--accent);
        width: 16px;
        font-size: 14px;
    }

    .event-description {
        color: var(--text-secondary);
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 24px;
    }

    .event-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
    }

    .event-price {
        display: flex;
        flex-direction: column;
    }

    .event-price-label {
        font-size: 12px;
        color: var(--text-tertiary);
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .event-price-value {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-primary);
    }

    .btn-outline {
        padding: 10px 20px;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text-primary);
        font-weight: 500;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-outline:hover {
        border-color: var(--accent);
        background: var(--accent-soft);
    }

    .btn-primary {
        padding: 12px 28px;
        background: var(--accent);
        color: white;
        border: none;
        border-radius: var(--radius-sm);
        font-weight: 500;
        font-size: 15px;
        text-decoration: none;
        transition: background 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary:hover {
        background: var(--accent-light);
    }

    /* Stats Bar */
    .stats-bar {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        padding: 48px 0;
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 36px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .stat-label {
        font-size: 14px;
        color: var(--text-tertiary);
        font-weight: 400;
    }

    /* Categories */
    .categories-section {
        padding: 80px 0;
        background: var(--off-white);
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .category-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 32px 24px;
        text-decoration: none;
        transition: all 0.2s;
        position: relative;
    }

    .category-card:hover {
        border-color: var(--accent);
        box-shadow: var(--shadow-md);
    }

    .category-icon {
        font-size: 28px;
        color: var(--accent);
        margin-bottom: 20px;
    }

    .category-name {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .category-count {
        font-size: 14px;
        color: var(--text-tertiary);
    }

    /* Newsletter */
    .newsletter-section {
        padding: 80px 0;
    }

    .newsletter-box {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
        border-radius: var(--radius-lg);
        padding: 64px;
        color: white;
        text-align: center;
    }

    .newsletter-title {
        font-size: 36px;
        font-weight: 700;
        color: white;
        margin-bottom: 16px;
    }

    .newsletter-desc {
        font-size: 18px;
        opacity: 0.9;
        margin-bottom: 32px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .newsletter-form {
        display: flex;
        gap: 12px;
        max-width: 480px;
        margin: 0 auto;
    }

    .newsletter-input {
        flex: 1;
        padding: 16px 20px;
        border: none;
        border-radius: var(--radius-sm);
        font-size: 16px;
        outline: none;
    }

    .newsletter-input::placeholder {
        color: var(--text-tertiary);
    }

    .newsletter-btn {
        padding: 16px 32px;
        background: white;
        color: var(--accent);
        border: none;
        border-radius: var(--radius-sm);
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .newsletter-btn:hover {
        background: var(--off-white);
        transform: translateY(-2px);
    }

    .newsletter-note {
        font-size: 14px;
        opacity: 0.8;
        margin-top: 24px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 40px;
        background: var(--off-white);
        border-radius: var(--radius-lg);
        border: 1px dashed var(--border);
    }

    .empty-state i {
        font-size: 48px;
        color: var(--text-tertiary);
        margin-bottom: 24px;
    }

    .empty-state h3 {
        font-size: 24px;
        margin-bottom: 12px;
    }

    .empty-state p {
        color: var(--text-secondary);
        margin-bottom: 24px;
    }

    /* Animations */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate {
        opacity: 0;
        animation: fadeUp 0.6s ease forwards;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .hero-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }
        
        .hero-content {
            max-width: 100%;
        }
        
        .events-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .categories-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .container-custom {
            padding: 0 20px;
        }
        
        .hero-section {
            padding: 40px 0;
        }
        
        .hero-stats {
            flex-direction: column;
            gap: 24px;
        }
        
        .events-grid {
            grid-template-columns: 1fr;
        }
        
        .event-card.featured {
            grid-column: span 1;
            grid-template-columns: 1fr;
        }
        
        .stats-bar {
            grid-template-columns: repeat(2, 1fr);
            gap: 32px;
        }
        
        .categories-grid {
            grid-template-columns: 1fr;
        }
        
        .newsletter-box {
            padding: 40px 24px;
        }
        
        .newsletter-form {
            flex-direction: column;
        }
        
        .section-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }
    }
</style>
@endpush

@section('content')
{{-- Hero Section --}}
<section class="hero-section">
    <div class="container-custom">
        <div class="hero-grid">
            <div class="hero-content">
                <span class="hero-eyebrow">Live Events Platform</span>
                <h1 class="hero-title">
                    Discover <span class="text-gradient">amazing events</span> in your city
                </h1>
                <p class="hero-subtitle">
                    From concerts and festivals to sports and culture. Book tickets instantly with no hidden fees.
                </p>

                <form action="{{ route('events.search') }}" method="GET" class="search-container">
                    <input 
                        type="text"
                        name="search"
                        class="search-input"
                        placeholder="Search events by name, location, or category..."
                        value="{{ request('search') }}"
                        autocomplete="off">
                    <button class="search-btn" type="submit">
                        <i class="fas fa-search"></i>
                        Search
                    </button>
                </form>

                <div class="hero-stats">
                    <div class="hero-stat">
                        <span class="hero-stat-num">500+</span>
                        <span class="hero-stat-label">Active events</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-num">50k+</span>
                        <span class="hero-stat-label">Happy customers</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-num">100+</span>
                        <span class="hero-stat-label">Cities</span>
                    </div>
                </div>
            </div>

            <div class="hero-image">
                <div class="hero-image-bg">
                    <div class="hero-image-grid">
                        <div class="hero-image-item">
                            <i class="fas fa-music"></i>
                            <span>Live Music</span>
                        </div>
                        <div class="hero-image-item">
                            <i class="fas fa-futbol"></i>
                            <span>Sports</span>
                        </div>
                        <div class="hero-image-item">
                            <i class="fas fa-palette"></i>
                            <span>Arts</span>
                        </div>
                        <div class="hero-image-item">
                            <i class="fas fa-utensils"></i>
                            <span>Food</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Events Section --}}
<section class="events-section">
    <div class="container-custom">
        <div class="section-header animate">
            <div class="section-header-left">
                <h2>Upcoming events</h2>
                <p>Hand-picked events you might like</p>
            </div>
            <a href="{{ route('events.index') }}" class="section-link">
                View all events <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        @if($upcomingEvents->isNotEmpty())
            <div class="events-grid">
                @foreach($upcomingEvents as $event)
                    @php $isFeatured = $loop->first; @endphp
                    
                    <div class="event-card {{ $isFeatured ? 'featured' : '' }} animate" 
                         style="animation-delay: {{ $loop->index * 0.1 }}s">
                        
                        @if($isFeatured)
                            <div class="event-card-content">
                                <span class="event-badge">Editor's pick</span>
                                <h3 class="event-title">{{ $event->event_name }}</h3>
                                <div class="event-meta">
                                    <div class="event-meta-item">
                                        <i class="far fa-calendar"></i>
                                        {{ \Carbon\Carbon::parse($event->eventDate)->format('l, F d, Y') }}
                                    </div>
                                    <div class="event-meta-item">
                                        <i class="far fa-clock"></i>
                                        {{ \Carbon\Carbon::parse($event->eventTime)->format('h:i A') }}
                                    </div>
                                    <div class="event-meta-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ Str::limit($event->location, 45) }}
                                    </div>
                                </div>
                                <p class="event-description">{{ Str::limit($event->description, 140) }}</p>
                            </div>
                            
                            <div class="event-card-sidebar">
                                @if($event->tickets->isNotEmpty())
                                    <div class="event-price">
                                        <span class="event-price-label">Starting from</span>
                                        <span class="event-price-value">${{ number_format($event->tickets->min('price'), 2) }}</span>
                                    </div>
                                @endif
                                <a href="{{ route('events.show', $event) }}" class="btn-primary" style="margin-top: 20px;">
                                    Get tickets <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                            
                        @else
                            <span class="event-badge {{ $loop->iteration <= 3 ? 'new' : '' }}">
                                {{ $loop->iteration <= 3 ? 'Just added' : 'Featured' }}
                            </span>
                            
                            <h3 class="event-title">{{ $event->event_name }}</h3>
                            
                            <div class="event-meta">
                                <div class="event-meta-item">
                                    <i class="far fa-calendar"></i>
                                    {{ \Carbon\Carbon::parse($event->eventDate)->format('M d, Y') }}
                                </div>
                                <div class="event-meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ Str::limit($event->location, 25) }}
                                </div>
                            </div>
                            
                            <p class="event-description">{{ Str::limit($event->description, 80) }}</p>
                            
                            <div class="event-footer">
                                @if($event->tickets->isNotEmpty())
                                    <div class="event-price">
                                        <span class="event-price-label">From</span>
                                        <span class="event-price-value">${{ number_format($event->tickets->min('price'), 2) }}</span>
                                    </div>
                                @endif
                                <a href="{{ route('events.show', $event) }}" class="btn-outline">
                                    Details <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state animate">
                <i class="far fa-calendar-times"></i>
                <h3>No upcoming events</h3>
                <p>Check back soon — new events are added daily.</p>
                <a href="{{ route('events.index') }}" class="btn-primary">
                    Browse events <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @endif
    </div>
</section>

{{-- Stats Bar --}}
<div class="container-custom">
    <div class="stats-bar animate">
        <div class="stat-item">
            <div class="stat-number">500+</div>
            <div class="stat-label">Events hosted</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">50k+</div>
            <div class="stat-label">Tickets sold</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">100+</div>
            <div class="stat-label">Cities covered</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">24/7</div>
            <div class="stat-label">Support</div>
        </div>
    </div>
</div>

{{-- Categories Section --}}
<section class="categories-section">
    <div class="container-custom">
        <div class="section-header animate">
            <div class="section-header-left">
                <h2>Browse by category</h2>
                <p>Find events that match your interests</p>
            </div>
        </div>

        <div class="categories-grid">
            <a href="{{ route('events.index') }}?category=music" class="category-card animate">
                <i class="fas fa-music category-icon"></i>
                <h3 class="category-name">Music</h3>
                <p class="category-count">Concerts & Festivals</p>
            </a>
            <a href="{{ route('events.index') }}?category=sports" class="category-card animate" style="animation-delay:0.1s">
                <i class="fas fa-futbol category-icon"></i>
                <h3 class="category-name">Sports</h3>
                <p class="category-count">Games & Tournaments</p>
            </a>
            <a href="{{ route('events.index') }}?category=arts" class="category-card animate" style="animation-delay:0.2s">
                <i class="fas fa-palette category-icon"></i>
                <h3 class="category-name">Arts</h3>
                <p class="category-count">Exhibitions & Theatre</p>
            </a>
            <a href="{{ route('events.index') }}?category=food" class="category-card animate" style="animation-delay:0.3s">
                <i class="fas fa-utensils category-icon"></i>
                <h3 class="category-name">Food</h3>
                <p class="category-count">Festivals & Tastings</p>
            </a>
        </div>
    </div>
</section>

{{-- Newsletter Section --}}
<section class="newsletter-section">
    <div class="container-custom">
        <div class="newsletter-box animate">
            <h2 class="newsletter-title">Never miss an event</h2>
            <p class="newsletter-desc">
                Get weekly picks, exclusive pre-sales, and the best events in your city
            </p>
            <form class="newsletter-form">
                <input type="email" class="newsletter-input" placeholder="Enter your email" required>
                <button type="submit" class="newsletter-btn">Subscribe</button>
            </form>
            <p class="newsletter-note">No spam. Unsubscribe anytime.</p>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Intersection Observer for animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    document.querySelectorAll('.animate:not(.animate)').forEach(el => observer.observe(el));
</script>
@endpush