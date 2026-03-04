@extends('layouts.app')

@section('title', 'Events')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500;600&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

<style>
    :root {
        --paper:     #f5f2ee;
        --paper-2:   #ede9e3;
        --paper-3:   #e3ddd5;
        --paper-4:   #d8d1c7;
        --line:      #d0c9be;
        --volt:      #5c8a00;
        --volt-bg:   #c8f135;
        --ink:       #1a1814;
        --ink-2:     #2e2b26;
        --ink-3:     #56514a;
        --ink-4:     #7a7470;
        --red-hot:   #c0392b;

        --font-display: 'Playfair Display', Georgia, serif;
        --font-body:    'DM Sans', sans-serif;
        --font-mono:    'Space Mono', monospace;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        background-color: var(--paper);
        color: var(--ink);
        font-family: var(--font-body);
        -webkit-font-smoothing: antialiased;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: fixed;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
        pointer-events: none;
        z-index: 9999;
        opacity: 0.5;
    }

    /* ── PAGE HEADER ── */
    .page-header {
        background: var(--paper-2);
        border-bottom: 1px solid var(--line);
        padding: 70px 0 0;
        margin-top: -24px;
        position: relative;
        overflow: hidden;
    }

    .page-header-bg {
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 55% 60% at 80% 50%, rgba(92,138,0,0.06) 0%, transparent 65%),
            radial-gradient(ellipse 35% 50% at 10% 80%, rgba(192,57,43,0.04) 0%, transparent 60%);
        pointer-events: none;
    }

    .page-header-inner {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: flex-end;
        gap: 40px;
        padding-bottom: 40px;
    }

    .page-header-eyebrow {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--volt);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-header-eyebrow::before {
        content: '';
        display: inline-block;
        width: 28px; height: 2px;
        background: var(--volt);
    }

    .page-header h1 {
        font-family: var(--font-display);
        font-size: clamp(2.8rem, 5vw, 5rem);
        font-weight: 900;
        color: var(--ink);
        letter-spacing: -0.02em;
        line-height: 1.0;
        margin-bottom: 14px;
    }

    .page-header h1 em {
        font-style: italic;
        color: var(--volt);
    }

    .page-header-sub {
        font-size: 1rem;
        color: var(--ink-3);
        font-weight: 300;
    }

    .page-header-count { text-align: right; flex-shrink: 0; }

    .page-header-count-num {
        font-family: var(--font-display);
        font-size: 3.5rem;
        font-weight: 900;
        color: var(--ink);
        line-height: 1;
    }

    .page-header-count-label {
        font-family: var(--font-mono);
        font-size: 0.6rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--ink-4);
        margin-top: 6px;
    }

    /* ── TOOLBAR ── */
    .toolbar {
        background: var(--paper-2);
        border-bottom: 1px solid var(--line);
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .toolbar-inner {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 0;
        flex-wrap: wrap;
    }

    /* Search */
    .toolbar-search {
        display: flex;
        align-items: center;
        border: 1px solid var(--line);
        background: var(--paper);
        overflow: hidden;
        flex: 1;
        min-width: 200px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .toolbar-search:focus-within {
        border-color: var(--volt);
        box-shadow: 0 0 0 3px rgba(92,138,0,0.1);
    }

    .toolbar-search i {
        padding: 0 14px;
        color: var(--ink-4);
        font-size: 0.8rem;
        flex-shrink: 0;
    }

    .toolbar-search input {
        flex: 1;
        background: transparent;
        border: none;
        color: var(--ink);
        font-family: var(--font-body);
        font-size: 0.9rem;
        padding: 12px 0;
        outline: none;
    }

    .toolbar-search input::placeholder { color: var(--ink-4); }

    .toolbar-search .btn-search {
        background: var(--volt-bg);
        color: var(--ink);
        border: none;
        border-left: 1px solid var(--line);
        padding: 12px 22px;
        font-family: var(--font-mono);
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        cursor: pointer;
        flex-shrink: 0;
        transition: background 0.2s;
    }

    .toolbar-search .btn-search:hover { background: #bde82a; }

    .toolbar-search .btn-clear {
        background: transparent;
        border: none;
        color: var(--ink-4);
        padding: 12px 14px;
        cursor: pointer;
        font-size: 0.75rem;
        transition: color 0.2s;
        flex-shrink: 0;
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .toolbar-search .btn-clear:hover { color: var(--red-hot); }

    .toolbar-divider {
        width: 1px; height: 28px;
        background: var(--line);
        flex-shrink: 0;
    }

    /* Filter pills */
    .filter-pills { display: flex; align-items: center; gap: 6px; }

    .filter-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-family: var(--font-body);
        font-size: 0.84rem;
        font-weight: 500;
        color: var(--ink-3);
        text-decoration: none;
        padding: 8px 18px;
        border-radius: 999px;
        border: 1px solid var(--line);
        background: transparent;
        cursor: pointer;
        transition: all 0.18s ease;
        white-space: nowrap;
    }

    .filter-pill i { font-size: 0.75rem; color: var(--ink-4); transition: color 0.18s; }

    .filter-pill:hover {
        border-color: var(--ink-3);
        color: var(--ink);
        background: var(--paper-3);
    }

    .filter-pill:hover i { color: var(--ink-3); }

    .filter-pill.active {
        background: var(--volt-bg);
        border-color: var(--volt-bg);
        color: var(--ink);
        font-weight: 600;
    }

    .filter-pill.active i { color: var(--ink); }

    /* Sort */
    .filter-sort {
        display: flex;
        align-items: center;
        border: 1px solid var(--line);
        border-radius: 999px;
        overflow: hidden;
        flex-shrink: 0;
        background: var(--paper);
        transition: border-color 0.18s;
        margin-left: auto;
    }

    .filter-sort:focus-within { border-color: var(--ink-3); }

    .filter-sort select {
        background: transparent;
        border: none;
        color: var(--ink-3);
        font-family: var(--font-body);
        font-size: 0.84rem;
        font-weight: 500;
        padding: 8px 32px 8px 16px;
        outline: none;
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
    }

    .filter-sort select option { background: var(--paper); color: var(--ink); }

    .filter-sort-icon {
        pointer-events: none;
        margin-left: -26px;
        margin-right: 12px;
        color: var(--ink-4);
        font-size: 0.65rem;
    }

    /* ── RESULTS META ── */
    .results-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 28px 0 24px;
        border-bottom: 1px solid var(--line);
    }

    .results-meta-text {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--ink-4);
    }

    .results-meta-text strong { color: var(--ink); font-weight: 700; }

    .results-search-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--paper-2);
        border: 1px solid var(--line);
        color: var(--ink-3);
        font-family: var(--font-mono);
        font-size: 0.62rem;
        letter-spacing: 0.1em;
        padding: 6px 14px;
        border-radius: 999px;
    }

    .results-search-tag a { color: var(--ink-4); text-decoration: none; transition: color 0.2s; }
    .results-search-tag a:hover { color: var(--red-hot) !important; }

    /* ── EVENTS GRID ── */
    .events-section { padding: 0; }

    .events-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1px;
        background: var(--line);
        border: 1px solid var(--line);
        border-top: none;
    }

    .event-card {
        background: var(--paper);
        padding: 32px;
        position: relative;
        transition: background 0.2s;
        display: flex;
        flex-direction: column;
        cursor: pointer;
        overflow: hidden;
    }

    .event-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0;
        width: 0; height: 3px;
        background: var(--volt-bg);
        transition: width 0.35s cubic-bezier(0.4,0,0.2,1);
    }

    .event-card:hover { background: var(--paper-2); }
    .event-card:hover::after { width: 100%; }

    .event-card-num {
        font-family: var(--font-mono);
        font-size: 0.58rem;
        color: var(--ink-4);
        letter-spacing: 0.2em;
        margin-bottom: 16px;
    }

    .event-badge-top {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: var(--volt-bg);
        color: var(--ink);
        font-family: var(--font-mono);
        font-size: 0.58rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        padding: 5px 12px;
        margin-bottom: 14px;
        width: fit-content;
    }

    .event-title {
        font-family: var(--font-display);
        font-size: 1.45rem;
        font-weight: 700;
        color: var(--ink);
        line-height: 1.2;
        margin-bottom: 16px;
        letter-spacing: -0.01em;
        transition: color 0.2s;
    }

    .event-card:hover .event-title { color: var(--volt); }

    .event-meta { display: flex; flex-direction: column; gap: 7px; margin-bottom: 16px; }

    .event-meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.82rem;
        color: var(--ink-3);
    }

    .event-meta-item i {
        font-size: 0.7rem;
        color: var(--volt);
        width: 12px;
        flex-shrink: 0;
    }

    .event-description {
        font-size: 0.88rem;
        color: var(--ink-3);
        line-height: 1.6;
        font-weight: 300;
        flex: 1;
        margin-bottom: 24px;
    }

    .event-footer-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
        padding-top: 18px;
        border-top: 1px solid var(--line);
    }

    .event-price {
        font-family: var(--font-mono);
        font-size: 0.9rem;
        color: var(--ink);
        font-weight: 700;
    }

    .event-price span {
        display: block;
        font-size: 0.58rem;
        font-weight: 400;
        color: var(--ink-4);
        letter-spacing: 0.1em;
        text-transform: uppercase;
        margin-bottom: 2px;
    }

    .btn-view {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-family: var(--font-mono);
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: var(--ink);
        text-decoration: none;
        padding: 10px 20px;
        border: 1px solid var(--line);
        background: transparent;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .btn-view:hover {
        background: var(--volt-bg);
        color: var(--ink) !important;
        border-color: var(--volt-bg);
    }

    .btn-view i { font-size: 0.65rem; transition: transform 0.2s; }
    .btn-view:hover i { transform: translateX(4px); }

    /* ── EMPTY STATE ── */
    .empty-state {
        padding: 80px 40px;
        text-align: center;
        border: 1px solid var(--line);
        border-top: none;
        background: var(--paper-2);
    }

    .empty-state i { font-size: 2.5rem; color: var(--ink-4); margin-bottom: 20px; display: block; }

    .empty-state h3 {
        font-family: var(--font-display);
        font-size: 1.8rem;
        color: var(--ink);
        margin-bottom: 10px;
    }

    .empty-state p { color: var(--ink-3); margin-bottom: 28px; }

    /* ── PAGINATION ── */
    .pagination-wrap {
        padding: 40px 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid var(--line);
        gap: 16px;
        flex-wrap: wrap;
    }

    .pagination-wrap .pagination { display: flex; gap: 4px; list-style: none; margin: 0; padding: 0; }

    .pagination-wrap .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px; height: 38px;
        background: var(--paper);
        border: 1px solid var(--line);
        color: var(--ink-4);
        font-family: var(--font-mono);
        font-size: 0.72rem;
        text-decoration: none;
        transition: all 0.18s;
        border-radius: 0;
    }

    .pagination-wrap .page-item .page-link:hover {
        background: var(--paper-3);
        border-color: var(--ink-3);
        color: var(--ink);
    }

    .pagination-wrap .page-item.active .page-link {
        background: var(--volt-bg);
        border-color: var(--volt-bg);
        color: var(--ink);
        font-weight: 700;
    }

    .pagination-wrap .page-item.disabled .page-link { opacity: 0.35; pointer-events: none; }

    .pagination-info {
        font-family: var(--font-mono);
        font-size: 0.62rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--ink-4);
    }

    /* ── ANIMATIONS ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .anim { opacity: 0; }
    .anim.visible { animation: fadeUp 0.55s cubic-bezier(0.2,0,0.3,1) forwards; }

    /* ── RESPONSIVE ── */
    @media (max-width: 1024px) {
        .events-grid { grid-template-columns: repeat(2, 1fr); }
        .page-header-inner { grid-template-columns: 1fr; }
        .page-header-count { text-align: left; }
    }

    @media (max-width: 768px) {
        .events-grid { grid-template-columns: 1fr; }
        .toolbar-inner { gap: 8px; }
        .filter-pills { display: none; }
        .toolbar-divider { display: none; }
        .filter-sort { margin-left: 0; }
        .pagination-wrap { justify-content: center; }
        .pagination-info { display: none; }
    }
</style>
@endpush

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="page-header">
    <div class="page-header-bg"></div>
    <div class="container-fluid px-4 px-lg-5">
        <div class="page-header-inner">
            <div>
                <div class="page-header-eyebrow">All Events</div>
                <h1>Discover <em>Events</em>.</h1>
                <p class="page-header-sub">Find the perfect experience — concerts, sports, arts, food and more.</p>
            </div>
            @if(isset($events) && $events->total())
                <div class="page-header-count">
                    <div class="page-header-count-num">{{ $events->total() }}</div>
                    <div class="page-header-count-label">Events Found</div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- ── STICKY TOOLBAR ── --}}
<div class="toolbar">
    <div class="container-fluid px-4 px-lg-5">
        <div class="toolbar-inner">

            <form action="{{ route('events.search') }}" method="GET" class="toolbar-search">
                <i class="fas fa-search"></i>
                <input type="text" name="search"
                       placeholder="Search events…"
                       value="{{ request('search') }}"
                       autocomplete="off">
                @if(request('search'))
                    <a href="{{ route('events.index') }}" class="btn-clear">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
                <button class="btn-search" type="submit">Search</button>
            </form>

            <div class="toolbar-divider"></div>

            <div class="filter-pills">
                <a href="{{ route('events.index') }}"
                   class="filter-pill {{ !request('category') ? 'active' : '' }}">All Events</a>
                <a href="{{ route('events.index') }}?category=music"
                   class="filter-pill {{ request('category') === 'music' ? 'active' : '' }}">
                    <i class="fas fa-music"></i> Music</a>
                <a href="{{ route('events.index') }}?category=sports"
                   class="filter-pill {{ request('category') === 'sports' ? 'active' : '' }}">
                    <i class="fas fa-futbol"></i> Sports</a>
                <a href="{{ route('events.index') }}?category=arts"
                   class="filter-pill {{ request('category') === 'arts' ? 'active' : '' }}">
                    <i class="fas fa-palette"></i> Arts</a>
                <a href="{{ route('events.index') }}?category=food"
                   class="filter-pill {{ request('category') === 'food' ? 'active' : '' }}">
                    <i class="fas fa-utensils"></i> Food</a>
            </div>

            <div class="filter-sort">
                <select id="sortSelect" aria-label="Sort events">
                    <option value="date_asc"  {{ request('sort') === 'date_asc'   ? 'selected' : '' }}>Date: Soonest First</option>
                    <option value="date_desc" {{ request('sort') === 'date_desc'  ? 'selected' : '' }}>Date: Latest First</option>
                    <option value="price_asc" {{ request('sort') === 'price_asc'  ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc"{{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="name_asc"  {{ request('sort') === 'name_asc'   ? 'selected' : '' }}>Name: A to Z</option>
                </select>
                <i class="fas fa-chevron-down filter-sort-icon"></i>
            </div>

        </div>
    </div>
</div>

{{-- ── MAIN CONTENT ── --}}
<div class="container-fluid px-4 px-lg-5">

    @if($events->isNotEmpty())
        <div class="results-meta anim">
            <span class="results-meta-text">
                Showing <strong>{{ $events->firstItem() }}–{{ $events->lastItem() }}</strong>
                of <strong>{{ $events->total() }}</strong> events
            </span>
            @if(request('search'))
                <span class="results-search-tag">
                    "{{ request('search') }}"
                    <a href="{{ route('events.index') }}" title="Clear search"><i class="fas fa-times"></i></a>
                </span>
            @endif
        </div>
    @endif

    <section class="events-section">
        @if($events->isNotEmpty())
            <div class="events-grid">
                @foreach($events as $event)
                    <div class="event-card anim" style="animation-delay: {{ ($loop->index % 3) * 0.07 }}s">
                        <div class="event-card-num">{{ str_pad($loop->iteration + ($events->currentPage() - 1) * $events->perPage(), 2, '0', STR_PAD_LEFT) }}</div>

                        @if($loop->first && !request()->has('page'))
                            <div class="event-badge-top"><i class="fas fa-bolt"></i> Top Pick</div>
                        @endif

                        <h3 class="event-title">{{ $event->event_name }}</h3>

                        <div class="event-meta">
                            <div class="event-meta-item">
                                <i class="fas fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($event->eventDate)->format('M d, Y') }}
                            </div>
                            <div class="event-meta-item">
                                <i class="fas fa-clock"></i>
                                {{ \Carbon\Carbon::parse($event->eventTime)->format('h:i A') }}
                            </div>
                            <div class="event-meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ Str::limit($event->location, 32) }}
                            </div>
                        </div>

                        <p class="event-description">{{ Str::limit($event->description, 90) }}</p>

                        <div class="event-footer-row">
                            @if($event->tickets->isNotEmpty())
                                <div class="event-price">
                                    <span>From</span>
                                    ${{ number_format($event->tickets->min('price'), 2) }}
                                </div>
                            @else
                                <div></div>
                            @endif
                            <a href="{{ route('events.show', $event) }}" class="btn-view">
                                View <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination-wrap anim">
                <span class="pagination-info">
                    Page {{ $events->currentPage() }} of {{ $events->lastPage() }}
                </span>
                {{ $events->withQueryString()->links() }}
            </div>

        @else
            <div class="empty-state anim">
                <i class="fas fa-calendar-times"></i>
                <h3>No Events Found</h3>
                <p>We couldn't find any events matching your criteria.</p>
                <a href="{{ route('events.index') }}" class="btn-view" style="display: inline-flex;">
                    Reset Filters <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @endif
    </section>

</div>

@endsection

@push('scripts')
<script>
    document.getElementById('sortSelect').addEventListener('change', function () {
        const url = new URL(window.location.href);
        url.searchParams.set('sort', this.value);
        window.location.href = url.toString();
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.06, rootMargin: '0px 0px -30px 0px' });

    document.querySelectorAll('.anim').forEach(el => observer.observe(el));
</script>
@endpush