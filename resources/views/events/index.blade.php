@extends('layouts.app')

@section('title', 'Events')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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
        --warning: #f59e0b;
        --error: #ef4444;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.02), 0 1px 2px rgba(0,0,0,0.02);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.01);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.02), 0 4px 6px -2px rgba(0,0,0,0.01);
        --radius-sm: 6px;
        --radius-md: 8px;
        --radius-lg: 12px;
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

    /* Page Header */
    .page-header {
        padding: 60px 0 40px;
        background: linear-gradient(to bottom, var(--white), var(--off-white));
        border-bottom: 1px solid var(--border);
    }

    .page-header-content {
        max-width: 800px;
    }

    .page-header-eyebrow {
        display: inline-block;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--accent);
        background: var(--accent-soft);
        padding: 6px 14px;
        border-radius: 100px;
        margin-bottom: 20px;
    }

    .page-header h1 {
        font-size: clamp(36px, 5vw, 56px);
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 16px;
        color: var(--text-primary);
    }

    .page-header-sub {
        font-size: 18px;
        color: var(--text-secondary);
        margin-bottom: 24px;
    }

    .page-header-stats {
        display: flex;
        gap: 32px;
    }

    .page-header-stat {
        display: flex;
        flex-direction: column;
    }

    .page-header-stat-number {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1.2;
    }

    .page-header-stat-label {
        font-size: 14px;
        color: var(--text-tertiary);
    }

    /* Toolbar */
    .toolbar {
        background: var(--white);
        border-bottom: 1px solid var(--border);
        position: sticky;
        top: 0;
        z-index: 100;
        padding: 16px 0;
    }

    .toolbar-inner {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    /* Search */
    .search-wrapper {
        flex: 1;
        min-width: 300px;
    }

    .search-form {
        display: flex;
        align-items: center;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        overflow: hidden;
        transition: all 0.2s;
    }

    .search-form:focus-within {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px var(--accent-soft);
    }

    .search-icon {
        padding: 0 16px;
        color: var(--text-tertiary);
        font-size: 14px;
    }

    .search-input {
        flex: 1;
        border: none;
        padding: 12px 0;
        font-size: 15px;
        color: var(--text-primary);
        background: transparent;
        outline: none;
    }

    .search-input::placeholder {
        color: var(--text-tertiary);
    }

    .search-clear {
        padding: 12px 16px;
        color: var(--text-tertiary);
        text-decoration: none;
        font-size: 14px;
        transition: color 0.2s;
    }

    .search-clear:hover {
        color: var(--error);
    }

    .search-btn {
        background: var(--accent);
        color: white;
        border: none;
        padding: 12px 28px;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .search-btn:hover {
        background: var(--accent-light);
    }

    /* Filter Pills */
    .filter-pills {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .filter-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 18px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 100px;
        color: var(--text-secondary);
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .filter-pill i {
        font-size: 14px;
        color: var(--text-tertiary);
        transition: color 0.2s;
    }

    .filter-pill:hover {
        border-color: var(--accent);
        color: var(--accent);
        background: var(--accent-soft);
    }

    .filter-pill:hover i {
        color: var(--accent);
    }

    .filter-pill.active {
        background: var(--accent);
        border-color: var(--accent);
        color: white;
    }

    .filter-pill.active i {
        color: white;
    }

    /* Sort Dropdown */
    .sort-wrapper {
        position: relative;
        min-width: 180px;
    }

    .sort-select {
        width: 100%;
        padding: 10px 32px 10px 16px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        color: var(--text-primary);
        font-size: 14px;
        font-weight: 500;
        appearance: none;
        cursor: pointer;
        outline: none;
        transition: border-color 0.2s;
    }

    .sort-select:focus {
        border-color: var(--accent);
    }

    .sort-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-tertiary);
        font-size: 12px;
        pointer-events: none;
    }

    /* Results Meta */
    .results-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 24px 0;
        border-bottom: 1px solid var(--border);
    }

    .results-count {
        font-size: 14px;
        color: var(--text-secondary);
    }

    .results-count strong {
        color: var(--text-primary);
        font-weight: 600;
    }

    .results-search-tag {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 6px 16px;
        background: var(--off-white);
        border: 1px solid var(--border);
        border-radius: 100px;
        font-size: 13px;
        color: var(--text-secondary);
    }

    .results-search-tag a {
        color: var(--text-tertiary);
        transition: color 0.2s;
    }

    .results-search-tag a:hover {
        color: var(--error);
    }

    /* Events Grid */
    .events-section {
        padding: 40px 0;
    }

    .events-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-bottom: 48px;
    }

    .event-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 24px;
        transition: all 0.2s;
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .event-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
        border-color: var(--accent-soft);
    }

    .event-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--accent-soft);
        color: var(--accent);
        font-size: 12px;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 100px;
        margin-bottom: 16px;
        width: fit-content;
    }

    .event-badge i {
        font-size: 12px;
    }

    .event-number {
        font-size: 12px;
        font-weight: 500;
        color: var(--text-tertiary);
        margin-bottom: 8px;
    }

    .event-title {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 16px;
        line-height: 1.3;
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
        margin-bottom: 20px;
        flex: 1;
    }

    .event-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
        padding-top: 16px;
        border-top: 1px solid var(--border);
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
        font-size: 18px;
        font-weight: 600;
        color: var(--text-primary);
    }

    .btn-outline {
        padding: 8px 18px;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text-primary);
        font-weight: 500;
        font-size: 13px;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-outline:hover {
        border-color: var(--accent);
        background: var(--accent-soft);
        color: var(--accent);
    }

    .btn-primary {
        padding: 10px 22px;
        background: var(--accent);
        color: white;
        border: none;
        border-radius: var(--radius-sm);
        font-weight: 500;
        font-size: 14px;
        text-decoration: none;
        transition: background 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary:hover {
        background: var(--accent-light);
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 24px 0;
        border-top: 1px solid var(--border);
    }

    .pagination-info {
        font-size: 14px;
        color: var(--text-secondary);
    }

    .pagination {
        display: flex;
        gap: 8px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text-secondary);
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
    }

    .page-item .page-link:hover {
        border-color: var(--accent);
        color: var(--accent);
        background: var(--accent-soft);
    }

    .page-item.active .page-link {
        background: var(--accent);
        border-color: var(--accent);
        color: white;
    }

    .page-item.disabled .page-link {
        opacity: 0.5;
        pointer-events: none;
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
        animation: fadeUp 0.5s ease forwards;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .events-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .container-custom {
            padding: 0 20px;
        }

        .page-header {
            padding: 40px 0 30px;
        }

        .page-header-stats {
            flex-direction: column;
            gap: 16px;
        }

        .toolbar-inner {
            flex-direction: column;
            align-items: stretch;
        }

        .search-wrapper {
            min-width: 100%;
        }

        .filter-pills {
            overflow-x: auto;
            padding-bottom: 8px;
            -webkit-overflow-scrolling: touch;
        }

        .filter-pill {
            flex-shrink: 0;
        }

        .events-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .pagination-wrapper {
            flex-direction: column;
            gap: 16px;
            align-items: center;
        }

        .results-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
    }
</style>
@endpush

@section('content')
{{-- Page Header --}}
<div class="page-header">
    <div class="container-custom">
        <div class="page-header-content">
            <span class="page-header-eyebrow">Live Events</span>
            <h1>Discover <span class="text-gradient">amazing events</span> near you</h1>
            <p class="page-header-sub">From intimate concerts to major festivals — find your next unforgettable experience</p>
            
            @if(isset($events) && $events->total())
                <div class="page-header-stats">
                    <div class="page-header-stat">
                        <span class="page-header-stat-number">{{ $events->total() }}</span>
                        <span class="page-header-stat-label">Total events</span>
                    </div>
                    <div class="page-header-stat">
                        <span class="page-header-stat-number">{{ ceil($events->total() / 10) }}</span>
                        <span class="page-header-stat-label">Categories</span>
                    </div>
                    <div class="page-header-stat">
                        <span class="page-header-stat-number">24/7</span>
                        <span class="page-header-stat-label">Support</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Sticky Toolbar --}}
<div class="toolbar">
    <div class="container-custom">
        <div class="toolbar-inner">
            {{-- Search --}}
            <div class="search-wrapper">
                <form action="{{ route('events.search') }}" method="GET" class="search-form">
                    <i class="bi bi-search search-icon"></i>
                    <input 
                        type="text" 
                        name="search"
                        class="search-input"
                        placeholder="Search by event name, location, or category..."
                        value="{{ request('search') }}"
                        autocomplete="off">
                    
                    @if(request('search'))
                        <a href="{{ route('events.index') }}" class="search-clear">
                            <i class="bi bi-x"></i>
                        </a>
                    @endif
                    
                    <button class="search-btn" type="submit">Search</button>
                </form>
            </div>

            {{-- Category Filters --}}
            <div class="filter-pills">
                <a href="{{ route('events.index') }}" 
                   class="filter-pill {{ !request('category') ? 'active' : '' }}">
                    All Events
                </a>

                @foreach(App\Models\Event::categories() as $name => $config)
                    <a href="{{ route('events.index') }}?category={{ urlencode($name) }}"
                       class="filter-pill {{ request('category') === $name ? 'active' : '' }}">
                        <i class="{{ $config['icon'] }}"></i>
                        {{ $name }}
                    </a>
                @endforeach
            </div>

            {{-- Sort Dropdown --}}
            <div class="sort-wrapper">
                <select class="sort-select" id="sortSelect" aria-label="Sort events">
                    <option value="date_asc" {{ request('sort') === 'date_asc' ? 'selected' : '' }}>Date: Soonest first</option>
                    <option value="date_desc" {{ request('sort') === 'date_desc' ? 'selected' : '' }}>Date: Latest first</option>
                    <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price: Low to high</option>
                    <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to low</option>
                    <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                </select>
                <i class="bi bi-chevron-down sort-icon"></i>
            </div>
        </div>
    </div>
</div>

{{-- Main Content --}}
<div class="container-custom">
    @if($events->isNotEmpty())
        {{-- Results Meta --}}
        <div class="results-meta animate">
            <span class="results-count">
                Showing <strong>{{ $events->firstItem() }}-{{ $events->lastItem() }}</strong>
                of <strong>{{ $events->total() }}</strong> events
            </span>
            
            @if(request('search'))
                <span class="results-search-tag">
                    <i class="bi bi-search"></i>
                    "{{ request('search') }}"
                    <a href="{{ route('events.index') }}" title="Clear search">
                        <i class="bi bi-x"></i>
                    </a>
                </span>
            @endif
        </div>

        {{-- Events Grid --}}
        <section class="events-section">
            <div class="events-grid">
                @foreach($events as $event)
                    <div class="event-card animate" style="animation-delay: {{ $loop->index * 0.05 }}s">
                        @if($loop->first && !request()->has('page'))
                            <div class="event-badge">
                                <i class="bi bi-star-fill"></i>
                                Top Pick
                            </div>
                        @endif
                        
                        <div class="event-number">
                            #{{ str_pad($loop->iteration + ($events->currentPage() - 1) * $events->perPage(), 2, '0', STR_PAD_LEFT) }}
                        </div>

                        <h3 class="event-title">{{ $event->name }}</h3>

                        <div class="event-meta">
                            <div class="event-meta-item">
                                <i class="bi bi-calendar3"></i>
                                {{ \Carbon\Carbon::parse($event->eventDate)->format('M d, Y') }}
                            </div>
                            <div class="event-meta-item">
                                <i class="bi bi-clock"></i>
                                {{ \Carbon\Carbon::parse($event->eventTime)->format('h:i A') }}
                            </div>
                            <div class="event-meta-item">
                                <i class="bi bi-geo-alt"></i>
                                {{ Str::limit($event->location, 30) }}
                            </div>
                            <div class="event-meta-item">
                                <i class="bi bi-tag"></i>
                                {{ $event->category }}
                            </div>
                        </div>

                        <p class="event-description">{{ Str::limit($event->description, 100) }}</p>

                        <div class="event-footer">
                            @if($event->tickets->isNotEmpty())
                                <div class="event-price">
                                    <span class="event-price-label">Starting from</span>
                                    <span class="event-price-value">${{ number_format($event->tickets->min('price'), 2) }}</span>
                                </div>
                            @else
                                <div class="event-price">
                                    <span class="event-price-label">Status</span>
                                    <span class="event-price-value">Free</span>
                                </div>
                            @endif

                            <a href="{{ route('events.show', $event) }}" class="btn-outline">
                                Details <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="pagination-wrapper animate">
                <span class="pagination-info">
                    Page {{ $events->currentPage() }} of {{ $events->lastPage() }}
                </span>
                
                {{ $events->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </section>

    @else
        {{-- Empty State --}}
        <div class="empty-state animate">
            <i class="bi bi-calendar-x"></i>
            <h3>No events found</h3>
            <p>We couldn't find any events matching your search criteria.</p>
            <a href="{{ route('events.index') }}" class="btn-primary">
                <i class="bi bi-arrow-counterclockwise"></i>
                Reset all filters
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Sort dropdown handler
    document.getElementById('sortSelect')?.addEventListener('change', function() {
        const url = new URL(window.location.href);
        url.searchParams.set('sort', this.value);
        window.location.href = url.toString();
    });

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

    // Sticky toolbar shadow on scroll
    const toolbar = document.querySelector('.toolbar');
    if (toolbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                toolbar.style.boxShadow = 'var(--shadow-md)';
            } else {
                toolbar.style.boxShadow = 'none';
            }
        });
    }
</script>
@endpush