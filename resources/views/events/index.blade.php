@extends('layouts.app')

@section('title', 'Events')

@push('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .page-header {
        background: var(--primary-gradient);
        padding: 60px 0;
        border-radius: 0 0 50px 50px;
        margin-top: -24px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
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

    .page-header-content {
        position: relative;
        z-index: 2;
        color: white;
        text-align: center;
    }

    .page-header-content h1 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        animation: fadeInUp 1s ease;
    }

    .page-header-content p {
        font-size: 1.2rem;
        opacity: 0.95;
        animation: fadeInUp 1s ease 0.2s both;
    }

    .search-wrapper {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 50px;
        padding: 5px;
        max-width: 600px;
        margin: 30px auto 0;
        animation: fadeInUp 1s ease 0.4s both;
    }

    .search-wrapper .form-control {
        background: transparent;
        border: none;
        color: white;
        font-size: 1rem;
        padding: 12px 20px;
    }

    .search-wrapper .form-control::placeholder {
        color: rgba(255,255,255,0.7);
    }

    .search-wrapper .form-control:focus {
        box-shadow: none;
        background: transparent;
        color: white;
    }

    .search-wrapper .btn-search {
        background: white;
        color: #667eea;
        border-radius: 50px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
    }

    .search-wrapper .btn-search:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    .search-wrapper .btn-clear {
        background: rgba(255,255,255,0.2);
        color: white;
        border-radius: 50px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.3);
        text-decoration: none;
        display: inline-block;
    }

    .search-wrapper .btn-clear:hover {
        background: rgba(255,255,255,0.3);
        color: white;
        transform: translateY(-2px);
    }

    .filter-section {
        background: white;
        border-radius: 20px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        align-items: center;
        justify-content: space-between;
    }

    .filter-tabs {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .filter-tab {
        padding: 8px 20px;
        border-radius: 50px;
        background: #f8f9fa;
        color: #666;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .filter-tab:hover {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .filter-tab.active {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .sort-dropdown {
        padding: 8px 25px;
        border-radius: 50px;
        border: 1px solid #e0e0e0;
        background: white;
        color: #666;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .sort-dropdown:hover {
        border-color: #667eea;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.1);
    }

    .sort-dropdown:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .events-grid {
        margin-top: 30px;
    }

    .event-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        height: 100%;
        position: relative;
        animation: fadeInUp 0.6s ease both;
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
        font-size: 1.4rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
        transition: color 0.3s ease;
        line-height: 1.3;
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
        font-size: 0.95rem;
    }

    .event-info-item i {
        width: 25px;
        color: #667eea;
        font-size: 1rem;
    }

    .event-description {
        color: #777;
        line-height: 1.6;
        margin-bottom: 15px;
        font-size: 0.9rem;
    }

    .price-tag {
        background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
        color: #667eea;
        padding: 8px 15px;
        border-radius: 50px;
        display: inline-block;
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 15px;
    }

    .price-tag i {
        margin-right: 5px;
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
        text-decoration: none;
        display: inline-block;
        text-align: center;
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

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: #f8f9fa;
        border-radius: 30px;
        margin: 40px 0;
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
        margin-bottom: 25px;
    }

    .pagination-wrapper {
        margin-top: 50px;
        margin-bottom: 30px;
    }

    .pagination-wrapper .pagination {
        justify-content: center;
        gap: 5px;
    }

    .pagination-wrapper .page-link {
        border: none;
        padding: 10px 18px;
        border-radius: 50px;
        color: #666;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .pagination-wrapper .page-link:hover {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .pagination-wrapper .page-item.active .page-link {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .pagination-wrapper .page-item.disabled .page-link {
        background: #f8f9fa;
        color: #999;
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

    /* Animation delays for cards */
    .event-card:nth-child(4n+1) { animation-delay: 0.1s; }
    .event-card:nth-child(4n+2) { animation-delay: 0.2s; }
    .event-card:nth-child(4n+3) { animation-delay: 0.3s; }
    .event-card:nth-child(4n+4) { animation-delay: 0.4s; }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header-content h1 {
            font-size: 2.2rem;
        }
        
        .filter-section {
            flex-direction: column;
            align-items: stretch;
        }
        
        .filter-tabs {
            justify-content: center;
        }
        
        .sort-dropdown {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="page-header-content">
            <h1>Discover Events</h1>
            <p>Find the perfect event that matches your interests</p>
            
            <!-- Search Form -->
            <div class="search-wrapper">
                <form action="{{ route('events.search') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search events by name, location, or description..." 
                           value="{{ request('search') }}">
                    <button class="btn-search" type="submit">
                        <i class="fas fa-search me-2"></i>Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('events.index') }}" class="btn-clear ms-2">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Filter Section -->
    <div class="filter-section">
        <div class="filter-tabs">
            <a href="{{ route('events.index') }}" class="filter-tab {{ !request('category') ? 'active' : '' }}">
                All Events
            </a>
            <a href="{{ route('events.index') }}?category=music" class="filter-tab {{ request('category') == 'music' ? 'active' : '' }}">
                <i class="fas fa-music me-2"></i>Music
            </a>
            <a href="{{ route('events.index') }}?category=sports" class="filter-tab {{ request('category') == 'sports' ? 'active' : '' }}">
                <i class="fas fa-futbol me-2"></i>Sports
            </a>
            <a href="{{ route('events.index') }}?category=arts" class="filter-tab {{ request('category') == 'arts' ? 'active' : '' }}">
                <i class="fas fa-palette me-2"></i>Arts
            </a>
            <a href="{{ route('events.index') }}?category=food" class="filter-tab {{ request('category') == 'food' ? 'active' : '' }}">
                <i class="fas fa-utensils me-2"></i>Food
            </a>
        </div>
        
        <div class="sort-section">
            <select class="sort-dropdown" id="sortSelect">
                <option value="date_asc">Date: Soonest First</option>
                <option value="date_desc">Date: Latest First</option>
                <option value="price_asc">Price: Low to High</option>
                <option value="price_desc">Price: High to Low</option>
                <option value="name_asc">Name: A to Z</option>
            </select>
        </div>
    </div>

    <!-- Events Grid -->
    <div class="events-grid">
        @if($events->isNotEmpty())
            <div class="row">
                @forelse($events as $event)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="event-card">
                            @if($loop->first && !request()->has('page'))
                                <div class="event-badge">
                                    <i class="fas fa-star me-1"></i>Top Pick
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="event-title">{{ $event->event_name }}</h5>
                                <div class="event-info">
                                    <div class="event-info-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>{{ \Carbon\Carbon::parse($event->eventDate)->format('M d, Y') }}</span>
                                    </div>
                                    <div class="event-info-item">
                                        <i class="fas fa-clock"></i>
                                        <span>{{ \Carbon\Carbon::parse($event->eventTime)->format('h:i A') }}</span>
                                    </div>
                                    <div class="event-info-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ Str::limit($event->location, 25) }}</span>
                                    </div>
                                </div>
                                
                                <p class="event-description">{{ Str::limit($event->description, 80) }}</p>
                                
                                @if($event->tickets->isNotEmpty())
                                    <div class="price-tag">
                                        <i class="fas fa-ticket-alt"></i>
                                        From ${{ number_format($event->tickets->min('price'), 2) }}
                                    </div>
                                @endif
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
            
            <!-- Results Info -->
            <div class="text-center text-muted mt-4">
                Showing {{ $events->firstItem() }} - {{ $events->lastItem() }} of {{ $events->total() }} events
            </div>
            
            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $events->withQueryString()->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-calendar-times"></i>
                <h3>No Events Found</h3>
                <p>We couldn't find any events matching your criteria.</p>
                <a href="{{ route('events.index') }}" class="btn-view" style="width: auto; padding: 12px 40px;">
                    <i class="fas fa-redo-alt me-2"></i>Reset Filters
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Sort functionality
    document.getElementById('sortSelect').addEventListener('change', function() {
        const sortValue = this.value;
        const url = new URL(window.location.href);
        url.searchParams.set('sort', sortValue);
        window.location.href = url.toString();
    });

    // Set selected sort option from URL
    const urlParams = new URLSearchParams(window.location.search);
    const sortParam = urlParams.get('sort');
    if (sortParam) {
        document.getElementById('sortSelect').value = sortParam;
    }

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
    
    document.querySelectorAll('.event-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease';
        observer.observe(el);
    });
</script>
@endpush