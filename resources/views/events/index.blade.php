@extends('layouts.app')

@section('title', 'Events')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,600;0,9..144,700;1,9..144,300&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* ══════════════════════════════════════════════════════
   TOKENS — mirrors home.blade.php
══════════════════════════════════════════════════════ */
:root {
    --ink:        #0d0d0d;
    --ink-2:      #1c1c1c;
    --ink-3:      #2e2e2e;
    --mist:       #f7f6f3;
    --mist-2:     #efede8;
    --border:     #e3e0d8;
    --gold:       #c9a84c;
    --gold-light: #e8c96a;
    --gold-soft:  #f5edd8;
    --white:      #ffffff;
    --text-body:  #4a4742;
    --text-muted: #8c8882;
    --success:    #2d7a5f;
    --error:      #c0392b;

    --f-display: 'Fraunces', Georgia, serif;
    --f-body:    'DM Sans', sans-serif;

    --r-sm:  4px;
    --r-md:  8px;
    --r-lg:  14px;
    --r-xl:  20px;

    --shadow-card: 0 2px 12px rgba(0,0,0,0.06), 0 1px 3px rgba(0,0,0,0.04);
    --shadow-lift: 0 12px 40px rgba(0,0,0,0.12), 0 4px 12px rgba(0,0,0,0.06);
}

*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
html { scroll-behavior: smooth; }

body {
    background: var(--mist);
    color: var(--ink);
    font-family: var(--f-body);
    line-height: 1.55;
    -webkit-font-smoothing: antialiased;
}

.wrap {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 40px;
}

/* ══════════════════════════════════════════════════════
   PAGE HERO — dark header strip
══════════════════════════════════════════════════════ */
.page-hero {
    background: var(--ink);
    padding: 64px 0 52px;
    position: relative;
    overflow: hidden;
}

.page-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
    background-size: 28px 28px;
    pointer-events: none;
}

.page-hero::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

.page-hero-inner {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 40px;
    flex-wrap: wrap;
}

.page-hero-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 16px;
}

.page-hero-label::before {
    content: '';
    display: block;
    width: 20px; height: 1px;
    background: var(--gold);
}

.page-hero-title {
    font-family: var(--f-display);
    font-size: clamp(38px, 5vw, 60px);
    font-weight: 600;
    line-height: 1.05;
    letter-spacing: -0.03em;
    color: var(--white);
    margin-bottom: 14px;
}

.page-hero-title em {
    font-style: italic;
    font-weight: 300;
    color: var(--gold);
}

.page-hero-sub {
    font-size: 16px;
    color: rgba(255,255,255,0.45);
    max-width: 480px;
    line-height: 1.6;
}

/* Stats cluster */
.page-hero-stats {
    display: flex;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: var(--r-lg);
    overflow: hidden;
    flex-shrink: 0;
    align-self: flex-end;
}

.phs-cell {
    padding: 20px 32px;
    text-align: center;
    border-right: 1px solid rgba(255,255,255,0.08);
}

.phs-cell:last-child { border-right: none; }

.phs-num {
    font-family: var(--f-display);
    font-size: 28px;
    font-weight: 600;
    color: var(--gold);
    line-height: 1;
    margin-bottom: 4px;
}

.phs-label {
    font-size: 11px;
    font-weight: 500;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.35);
}

/* ══════════════════════════════════════════════════════
   STICKY TOOLBAR
══════════════════════════════════════════════════════ */
.toolbar {
    background: var(--white);
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: var(--nav-h);
    z-index: 200;
    padding: 14px 0;
    transition: box-shadow 0.25s;
}

.toolbar-inner {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

/* Search */
.search-wrap { flex: 1; min-width: 280px; }

.search-form {
    display: flex;
    align-items: center;
    background: var(--mist);
    border: 1px solid var(--border);
    border-radius: var(--r-md);
    overflow: hidden;
    transition: all 0.2s;
}

.search-form:focus-within {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(201,168,76,0.15);
    background: var(--white);
}

.search-icon { padding: 0 14px; color: var(--text-muted); font-size: 14px; }

.search-input {
    flex: 1;
    border: none;
    background: transparent;
    padding: 11px 0;
    font-family: var(--f-body);
    font-size: 14px;
    color: var(--ink);
    outline: none;
}

.search-input::placeholder { color: var(--text-muted); }

.search-clear {
    padding: 11px 14px;
    color: var(--text-muted);
    text-decoration: none;
    font-size: 14px;
    transition: color 0.2s;
}

.search-clear:hover { color: var(--error); }

.search-btn {
    background: var(--ink);
    color: var(--white);
    border: none;
    padding: 11px 24px;
    font-family: var(--f-body);
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
    white-space: nowrap;
}

.search-btn:hover { background: var(--ink-3); }

/* Filter pills */
.filter-pills {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
}

.filter-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 16px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 100px;
    color: var(--text-body);
    font-family: var(--f-body);
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
    white-space: nowrap;
}

.filter-pill i { font-size: 12px; color: var(--text-muted); transition: color 0.2s; }

.filter-pill:hover {
    border-color: var(--gold);
    color: var(--ink);
    background: var(--gold-soft);
}

.filter-pill:hover i { color: var(--gold); }

.filter-pill.active {
    background: var(--ink);
    border-color: var(--ink);
    color: var(--white);
}

.filter-pill.active i { color: var(--gold); }

/* Sort dropdown */
.sort-wrap { position: relative; min-width: 190px; }

.sort-select {
    width: 100%;
    padding: 10px 32px 10px 14px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-md);
    font-family: var(--f-body);
    color: var(--ink);
    font-size: 13px;
    font-weight: 500;
    appearance: none;
    cursor: pointer;
    outline: none;
    transition: border-color 0.2s;
}

.sort-select:focus { border-color: var(--gold); }

.sort-chevron {
    position: absolute;
    right: 11px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 11px;
    pointer-events: none;
}

/* ══════════════════════════════════════════════════════
   RESULTS META BAR
══════════════════════════════════════════════════════ */
.results-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 0;
    border-bottom: 1px solid var(--border);
    margin-bottom: 32px;
}

.results-text {
    font-size: 14px;
    color: var(--text-muted);
}

.results-text strong { color: var(--ink); font-weight: 600; }

.results-tag {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 5px 14px;
    background: var(--gold-soft);
    border: 1px solid #e8d9a0;
    border-radius: 100px;
    font-size: 13px;
    color: #8a6a1a;
    font-weight: 500;
}

.results-tag a {
    color: #8a6a1a;
    opacity: 0.6;
    transition: opacity 0.2s;
    text-decoration: none;
}

.results-tag a:hover { opacity: 1; }

/* ══════════════════════════════════════════════════════
   EVENTS GRID
══════════════════════════════════════════════════════ */
.events-section { padding: 40px 0 80px; }

.events-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 48px;
}

.event-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: box-shadow 0.25s, transform 0.25s;
}

.event-card:hover {
    box-shadow: var(--shadow-lift);
    transform: translateY(-3px);
}

/* Category colour strip */
.card-strip { height: 3px; width: 100%; flex-shrink: 0; }

.card-body {
    padding: 24px 26px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

/* Top row: status pill + card number */
.card-top-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 14px;
}

.card-status {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 4px;
}

.card-status.upcoming  { background: #dbeafe; color: #1d4ed8; }
.card-status.ongoing   { background: #d1fae5; color: #065f46; }
.card-status.completed { background: #f3f4f6; color: #4b5563; }

.card-num {
    font-size: 11px;
    font-weight: 600;
    color: var(--text-muted);
    letter-spacing: 0.04em;
}

/* Top pick badge */
.card-toppick {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: var(--gold-soft);
    color: #8a6a1a;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 4px;
    margin-bottom: 10px;
    width: fit-content;
}

.card-toppick i { font-size: 10px; }

/* Category label */
.card-category {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 10px;
}

.card-category i { color: var(--gold); }

/* Title */
.card-title {
    font-family: var(--f-display);
    font-size: 19px;
    font-weight: 600;
    color: var(--ink);
    line-height: 1.25;
    letter-spacing: -0.02em;
    margin-bottom: 14px;
}

/* Meta rows */
.card-meta {
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin-bottom: 14px;
}

.card-meta-row {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: var(--text-muted);
}

.card-meta-row i {
    color: var(--gold);
    font-size: 12px;
    width: 13px;
    flex-shrink: 0;
}

/* Description */
.card-desc {
    font-size: 13px;
    color: var(--text-body);
    line-height: 1.6;
    margin-bottom: 20px;
    flex: 1;
}

/* Footer */
.card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 16px;
    border-top: 1px solid var(--border);
    margin-top: auto;
    gap: 12px;
}

.card-price-label {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 2px;
}

.card-price-value {
    font-family: var(--f-display);
    font-size: 22px;
    font-weight: 600;
    color: var(--ink);
    line-height: 1;
}

.card-price-free {
    font-family: var(--f-display);
    font-size: 22px;
    font-weight: 600;
    color: var(--success);
    line-height: 1;
}

.btn-card {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: var(--ink);
    color: var(--white);
    font-family: var(--f-body);
    font-size: 13px;
    font-weight: 600;
    padding: 10px 18px;
    border-radius: var(--r-sm);
    text-decoration: none;
    transition: all 0.2s;
    white-space: nowrap;
    flex-shrink: 0;
}

.btn-card:hover {
    background: var(--gold);
    color: var(--ink);
    transform: translateY(-1px);
}

/* ══════════════════════════════════════════════════════
   PAGINATION
══════════════════════════════════════════════════════ */
.pagination-wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 28px 0;
    border-top: 1px solid var(--border);
    gap: 20px;
    flex-wrap: wrap;
}

.pagination-info { font-size: 13px; color: var(--text-muted); }

.pagination { gap: 6px; margin: 0; padding: 0; list-style: none; display: flex; }

.page-item .page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border: 1px solid var(--border);
    border-radius: var(--r-sm);
    font-family: var(--f-body);
    font-size: 13px;
    font-weight: 600;
    color: var(--text-body);
    text-decoration: none;
    background: var(--white);
    transition: all 0.2s;
}

.page-item .page-link:hover {
    border-color: var(--gold);
    color: var(--ink);
    background: var(--gold-soft);
}

.page-item.active .page-link {
    background: var(--ink);
    border-color: var(--ink);
    color: var(--white);
}

.page-item.disabled .page-link { opacity: 0.35; pointer-events: none; }

/* ══════════════════════════════════════════════════════
   EMPTY STATE
══════════════════════════════════════════════════════ */
.empty-state {
    text-align: center;
    padding: 80px 40px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    margin: 40px 0 80px;
}

.empty-state i {
    font-size: 44px;
    color: var(--text-muted);
    margin-bottom: 20px;
    display: block;
    opacity: 0.4;
}

.empty-state h3 {
    font-family: var(--f-display);
    font-size: 28px;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 10px;
}

.empty-state p {
    color: var(--text-muted);
    font-size: 15px;
    margin-bottom: 28px;
    max-width: 380px;
    margin-left: auto;
    margin-right: auto;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--ink);
    color: var(--white);
    font-family: var(--f-body);
    font-size: 14px;
    font-weight: 600;
    padding: 12px 28px;
    border-radius: var(--r-md);
    text-decoration: none;
    transition: all 0.2s;
}

.btn-primary:hover {
    background: var(--gold);
    color: var(--ink);
    transform: translateY(-1px);
}

/* ══════════════════════════════════════════════════════
   ANIMATIONS
══════════════════════════════════════════════════════ */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

.fade-up {
    opacity: 0;
    animation: fadeUp 0.5s cubic-bezier(0.22, 1, 0.36, 1) forwards;
}

/* ══════════════════════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════════════════════ */
@media (max-width: 1024px) {
    .events-grid { grid-template-columns: repeat(2, 1fr); }
    .page-hero-stats { display: none; }
}

@media (max-width: 768px) {
    .wrap { padding: 0 20px; }
    .page-hero { padding: 48px 0 40px; }
    .toolbar { top: var(--nav-h); }
    .toolbar-inner { flex-direction: column; align-items: stretch; }
    .search-wrap { min-width: 100%; }
    .filter-pills { overflow-x: auto; padding-bottom: 6px; flex-wrap: nowrap; -webkit-overflow-scrolling: touch; }
    .filter-pill { flex-shrink: 0; }
    .events-grid { grid-template-columns: 1fr; gap: 14px; }
    .pagination-wrap { flex-direction: column; align-items: center; }
    .results-bar { flex-direction: column; align-items: flex-start; gap: 10px; }
}
</style>
@endpush

@section('content')

{{-- ══ PAGE HERO ══════════════════════════════════════════════ --}}
<div class="page-hero">
    <div class="wrap">
        <div class="page-hero-inner">

            <div>
                <div class="page-hero-label">Live Events</div>
                <h1 class="page-hero-title">
                    Find your next<br>
                    <em>unforgettable</em> experience
                </h1>
                <p class="page-hero-sub">
                    Concerts, festivals, sports, culture — browse every event and book tickets instantly.
                </p>
            </div>

            @if(isset($events) && $events->total())
            <div class="page-hero-stats">
                <div class="phs-cell">
                    <div class="phs-num">{{ $events->total() }}</div>
                    <div class="phs-label">Events</div>
                </div>
                <div class="phs-cell">
                    <div class="phs-num">{{ count(App\Models\Event::categories()) }}</div>
                    <div class="phs-label">Categories</div>
                </div>
                <div class="phs-cell">
                    <div class="phs-num">24/7</div>
                    <div class="phs-label">Support</div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

{{-- ══ STICKY TOOLBAR ═════════════════════════════════════════ --}}
<div class="toolbar" id="toolbar">
    <div class="wrap">
        <div class="toolbar-inner">

            {{-- Search --}}
            <div class="search-wrap">
                <form action="{{ route('events.index') }}" method="GET" class="search-form">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif

                    <i class="bi bi-search search-icon"></i>
                    <input
                        type="text"
                        name="search"
                        class="search-input"
                        placeholder="Search events, locations, categories..."
                        value="{{ request('search') }}"
                        autocomplete="off">

                    @if(request('search'))
                        <a href="{{ route('events.index', array_filter(['category' => request('category'), 'sort' => request('sort')])) }}"
                           class="search-clear" title="Clear search">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif

                    <button class="search-btn" type="submit">Search</button>
                </form>
            </div>

            {{-- Category pills --}}
            <div class="filter-pills">
                <a href="{{ route('events.index', array_filter(['search' => request('search'), 'sort' => request('sort')])) }}"
                   class="filter-pill {{ !request('category') ? 'active' : '' }}">
                    All
                </a>

                @foreach(App\Models\Event::categories() as $name => $config)
                    <a href="{{ route('events.index', array_filter(['category' => $name, 'search' => request('search'), 'sort' => request('sort')])) }}"
                       class="filter-pill {{ request('category') === $name ? 'active' : '' }}">
                        <i class="{{ $config['icon'] }}"></i>
                        {{ $name }}
                    </a>
                @endforeach
            </div>

            {{-- Sort --}}
            <div class="sort-wrap">
                <select class="sort-select" id="sortSelect" aria-label="Sort events">
                    <option value="date_asc"   {{ request('sort', 'date_asc') === 'date_asc'   ? 'selected' : '' }}>Soonest first</option>
                    <option value="date_desc"  {{ request('sort') === 'date_desc'  ? 'selected' : '' }}>Latest first</option>
                    <option value="price_asc"  {{ request('sort') === 'price_asc'  ? 'selected' : '' }}>Price: Low → High</option>
                    <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High → Low</option>
                    <option value="name_asc"   {{ request('sort') === 'name_asc'   ? 'selected' : '' }}>Name: A → Z</option>
                    <option value="name_desc"  {{ request('sort') === 'name_desc'  ? 'selected' : '' }}>Name: Z → A</option>
                </select>
                <i class="bi bi-chevron-down sort-chevron"></i>
            </div>

        </div>
    </div>
</div>

{{-- ══ MAIN CONTENT ═══════════════════════════════════════════ --}}
<div class="wrap">

    @if($events->isNotEmpty())

        {{-- Results bar --}}
        <div class="results-bar fade-up">
            <span class="results-text">
                Showing <strong>{{ $events->firstItem() }}–{{ $events->lastItem() }}</strong>
                of <strong>{{ $events->total() }}</strong> events
                @if(request('category'))
                    &nbsp;in&nbsp;<strong>{{ request('category') }}</strong>
                @endif
            </span>

            @if(request('search'))
                <span class="results-tag">
                    <i class="bi bi-search"></i>
                    "{{ request('search') }}"
                    <a href="{{ route('events.index', array_filter(['category' => request('category'), 'sort' => request('sort')])) }}"
                       title="Clear search">
                        <i class="bi bi-x"></i>
                    </a>
                </span>
            @endif
        </div>

        {{-- Events Grid --}}
        <section class="events-section">
            <div class="events-grid">
                @foreach($events as $event)
                @php
                    // Pull color directly from Event::categories() — single source of truth
                    $strip = $event->category_color;
                    $delay = $loop->index * 0.05;
                    $num   = str_pad(($events->currentPage() - 1) * $events->perPage() + $loop->iteration, 3, '0', STR_PAD_LEFT);
                @endphp

                <div class="event-card fade-up"
                     data-event-id="{{ $event->id }}"
                     style="animation-delay: {{ $delay }}s">

                    {{-- Category colour strip --}}
                    <div class="card-strip" style="background: {{ $strip }};"></div>

                    <div class="card-body">

                        {{-- Status + number --}}
                        <div class="card-top-row">
                            <span class="card-status {{ $event->live_status }}"
                                  data-status="{{ $event->live_status }}">
                                @if($event->live_status === 'upcoming')
                                    <i class="bi bi-clock"></i> Upcoming
                                @elseif($event->live_status === 'ongoing')
                                    <i class="bi bi-record-circle-fill"></i> Ongoing
                                @elseif($event->live_status === 'completed')
                                    <i class="bi bi-check-circle"></i> Completed
                                @endif
                            </span>
                            <span class="card-num">#{{ $num }}</span>
                        </div>

                        {{-- Top pick badge (first card, first page, not searching) --}}
                        @if($loop->first && $events->currentPage() === 1 && !request('search'))
                            <div class="card-toppick">
                                <i class="bi bi-star-fill"></i>
                                Top Pick
                            </div>
                        @endif

                        {{-- Category --}}
                        @if($event->category)
                        <div class="card-category">
                            <i class="{{ $event->category_icon }}"></i>
                            {{ $event->category }}
                        </div>
                        @endif

                        {{-- Title --}}
                        <h3 class="card-title">{{ $event->name }}</h3>

                        {{-- Meta --}}
                        <div class="card-meta">
                            <div class="card-meta-row">
                                <i class="bi bi-calendar3"></i>
                                {{ $event->formatted_date }}
                            </div>
                            <div class="card-meta-row">
                                <i class="bi bi-clock"></i>
                                {{ $event->formatted_time }}
                            </div>
                            <div class="card-meta-row">
                                <i class="bi bi-geo-alt"></i>
                                {{ Str::limit($event->location, 38) }}
                            </div>
                        </div>

                        {{-- Description --}}
                        <p class="card-desc">{{ Str::limit($event->description, 100) }}</p>

                        {{-- Footer --}}
                        <div class="card-footer">
                            <div>
                                @if($event->tickets->isNotEmpty())
                                    <div class="card-price-label">
                                        {{ $event->min_price !== null ? 'From' : 'Admission' }}
                                    </div>
                                    @if($event->min_price !== null)
                                        <div class="card-price-value">${{ number_format($event->min_price, 2) }}</div>
                                    @else
                                        <div class="card-price-free">Free</div>
                                    @endif
                                @else
                                    <div class="card-price-label">Tickets</div>
                                    <div style="font-size:13px; color:var(--text-muted); font-style:italic;">Not available</div>
                                @endif
                            </div>

                            <a href="{{ route('events.show', $event) }}" class="btn-card">
                                Details <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="pagination-wrap fade-up">
                <span class="pagination-info">
                    Page {{ $events->currentPage() }} of {{ $events->lastPage() }}
                </span>
                {{ $events->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </section>

    @else

        {{-- Empty state --}}
        <div class="empty-state fade-up">
            <i class="bi bi-calendar-x"></i>
            <h3>No events found</h3>
            <p>
                @if(request('search') || request('category'))
                    Nothing matched your filters. Try a different search or category.
                @else
                    No upcoming events right now. Check back soon!
                @endif
            </p>
            <a href="{{ route('events.index') }}" class="btn-primary">
                <i class="bi bi-arrow-counterclockwise"></i>
                Reset filters
            </a>
        </div>

    @endif

</div>

@endsection

@push('scripts')
<script>
// Sort → update URL, reset to page 1
document.getElementById('sortSelect')?.addEventListener('change', function () {
    const url = new URL(window.location.href);
    url.searchParams.set('sort', this.value);
    url.searchParams.delete('page');
    window.location.href = url.toString();
});

// Toolbar shadow on scroll
const toolbar = document.getElementById('toolbar');
if (toolbar) {
    window.addEventListener('scroll', () => {
        toolbar.style.boxShadow = window.scrollY > 60
            ? '0 4px 24px rgba(0,0,0,0.08)'
            : 'none';
    }, { passive: true });
}

// Staggered card animations
const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animationPlayState = 'running';
            io.unobserve(entry.target);
        }
    });
}, { threshold: 0.07, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('.fade-up').forEach(el => {
    el.style.animationPlayState = 'paused';
    io.observe(el);
});
</script>

<script>
(function () {
    const INTERVAL = 15000;

    const STATUS_CONFIG = {
        upcoming: { label: 'Upcoming', icon: 'bi-clock',              cls: 'upcoming' },
        ongoing:  { label: 'Ongoing',  icon: 'bi-record-circle-fill', cls: 'ongoing'  },
    };

    async function pollStatuses() {
        try {
            const res  = await fetch('/events/status/poll');
            if (!res.ok) return;
            const data = await res.json();

            Object.entries(data).forEach(([id, status]) => {
                const config = STATUS_CONFIG[status];
                if (!config) return;

                document.querySelectorAll(`[data-event-id="${id}"] .card-status`)
                    .forEach(badge => {
                        if (badge.dataset.status === status) return;
                        badge.dataset.status = status;
                        badge.className      = `card-status ${config.cls}`;
                        badge.innerHTML      = `<i class="bi ${config.icon}"></i> ${config.label}`;

                        badge.style.transition = 'none';
                        badge.style.outline    = '2px solid var(--gold)';
                        setTimeout(() => {
                            badge.style.transition = 'outline 0.6s ease';
                            badge.style.outline    = '2px solid transparent';
                        }, 600);
                    });
            });
        } catch (e) {}
    }

    document.addEventListener('visibilitychange', () => {
        if (!document.hidden) pollStatuses();
    });

    pollStatuses();
    setInterval(pollStatuses, INTERVAL);
})();
</script>

@endpush