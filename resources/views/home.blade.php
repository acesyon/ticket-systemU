@extends('layouts.app')

@section('title', 'Home')

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
        --volt:      #5c8a00;      /* deep green — readable on light */
        --volt-bg:   #c8f135;      /* lime fill for badges/buttons */
        --volt-dim:  #4a7000;
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

    /* ─── HERO ─── */
    .hero-section {
        min-height: 92vh;
        display: grid;
        grid-template-rows: 1fr auto;
        position: relative;
        overflow: hidden;
        padding: 0;
        margin-top: -24px;
        border-bottom: 1px solid var(--line);
    }

    .hero-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 80vh;
    }

    .hero-left {
        padding: 90px 60px 60px 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        border-right: 1px solid var(--line);
        background: var(--paper);
    }

    .hero-eyebrow {
        font-family: var(--font-mono);
        font-size: 0.72rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--volt);
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .hero-eyebrow::before {
        content: '';
        display: inline-block;
        width: 32px; height: 2px;
        background: var(--volt);
    }

    .hero-title {
        font-family: var(--font-display);
        font-size: clamp(3.2rem, 5.5vw, 6rem);
        font-weight: 900;
        line-height: 1.0;
        color: var(--ink);
        letter-spacing: -0.02em;
        margin-bottom: 32px;
    }

    .hero-title em {
        font-style: italic;
        color: var(--volt);
        display: block;
    }

    .hero-subtitle {
        font-size: 1.05rem;
        color: var(--ink-3);
        line-height: 1.65;
        max-width: 420px;
        font-weight: 300;
        margin-bottom: 48px;
    }

    .hero-right {
        background: var(--paper-2);
        position: relative;
        overflow: hidden;
    }

    .hero-right-bg {
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 60% 50% at 70% 30%, rgba(92,138,0,0.08) 0%, transparent 70%),
            radial-gradient(ellipse 40% 60% at 30% 80%, rgba(192,57,43,0.05) 0%, transparent 60%);
    }

    /* Ticker */
    .hero-ticker {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        background: var(--volt-bg);
        padding: 11px 0;
        overflow: hidden;
        z-index: 3;
        border-top: 1px solid rgba(0,0,0,0.08);
    }

    .hero-ticker-inner {
        display: flex;
        animation: ticker 28s linear infinite;
        white-space: nowrap;
    }

    .ticker-item {
        font-family: var(--font-mono);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--ink);
        padding: 0 40px;
        flex-shrink: 0;
    }

    .ticker-dot {
        display: inline-block;
        width: 6px; height: 6px;
        background: var(--ink);
        border-radius: 50%;
        vertical-align: middle;
        margin: 0 20px;
    }

    @keyframes ticker { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

    /* Hero stats */
    .hero-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        border-top: 1px solid var(--line);
        background: var(--paper);
    }

    .hero-stat {
        padding: 28px 60px;
        border-right: 1px solid var(--line);
    }

    .hero-stat:last-child { border-right: none; }

    .hero-stat-num {
        font-family: var(--font-display);
        font-size: 2.6rem;
        font-weight: 900;
        color: var(--ink);
        line-height: 1;
    }

    .hero-stat-label {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--ink-4);
        margin-top: 6px;
    }

    /* ─── SEARCH ─── */
    .search-bar {
        display: flex;
        border: 1px solid var(--line);
        overflow: hidden;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: var(--paper-2);
    }

    .search-bar:focus-within {
        border-color: var(--volt);
        box-shadow: 0 0 0 3px rgba(92,138,0,0.1);
    }

    .search-bar .form-control {
        background: transparent;
        border: none;
        color: var(--ink);
        font-size: 1rem;
        font-family: var(--font-body);
        padding: 18px 28px;
        flex: 1;
        outline: none;
        box-shadow: none;
    }

    .search-bar .form-control::placeholder { color: var(--ink-4); }
    .search-bar .form-control:focus { background: transparent; color: var(--ink); box-shadow: none; }

    .btn-search {
        background: var(--volt-bg);
        color: var(--ink);
        border: none;
        border-left: 1px solid var(--line);
        padding: 18px 40px;
        font-family: var(--font-mono);
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.2s;
        flex-shrink: 0;
    }

    .btn-search:hover { background: #bde82a; }

    /* ─── SECTION HEAD ─── */
    .section-head {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin-bottom: 48px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--line);
    }

    .section-label {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--volt);
        margin-bottom: 8px;
    }

    .section-head h2 {
        font-family: var(--font-display);
        font-size: 2.6rem;
        font-weight: 900;
        color: var(--ink);
        letter-spacing: -0.02em;
        line-height: 1.1;
    }

    .section-head-link {
        font-family: var(--font-mono);
        font-size: 0.72rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--ink-3);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        border-bottom: 1px solid var(--ink-3);
        padding-bottom: 2px;
        transition: color 0.2s, border-color 0.2s;
        white-space: nowrap;
    }

    .section-head-link:hover { color: var(--volt) !important; border-color: var(--volt); }

    /* ─── EVENTS SECTION ─── */
    .events-section {
        padding: 80px 0;
        background: var(--paper);
    }

    .events-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1px;
        background: var(--line);
        border: 1px solid var(--line);
    }

    .event-card {
        background: var(--paper);
        padding: 36px;
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

    .event-card.is-featured {
        grid-column: span 2;
        background: var(--paper-2);
        flex-direction: row;
        gap: 40px;
        padding: 48px;
    }

    .event-card.is-featured::after { height: 4px; }

    .featured-left { flex: 1; }
    .featured-right {
        width: 200px;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: space-between;
        flex-shrink: 0;
    }

    .event-number {
        font-family: var(--font-mono);
        font-size: 0.62rem;
        color: var(--ink-4);
        letter-spacing: 0.2em;
        margin-bottom: 20px;
    }

    .event-badge-featured {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--volt-bg);
        color: var(--ink);
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        padding: 6px 14px;
        margin-bottom: 20px;
    }

    .event-badge-new {
        display: inline-flex;
        background: var(--red-hot);
        color: white;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        padding: 5px 12px;
        margin-bottom: 16px;
    }

    .event-title {
        font-family: var(--font-display);
        font-size: 1.55rem;
        font-weight: 700;
        color: var(--ink);
        line-height: 1.2;
        margin-bottom: 16px;
        letter-spacing: -0.01em;
        transition: color 0.2s;
    }

    .event-card:hover .event-title { color: var(--volt); }

    .is-featured .event-title { font-size: 2.2rem; margin-bottom: 20px; }

    .event-meta { display: flex; flex-direction: column; gap: 8px; margin-bottom: 20px; }

    .event-meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.85rem;
        color: var(--ink-3);
    }

    .event-meta-item i {
        font-size: 0.75rem;
        color: var(--volt);
        width: 14px;
        flex-shrink: 0;
    }

    .event-description {
        font-size: 0.9rem;
        color: var(--ink-3);
        line-height: 1.6;
        font-weight: 300;
        flex: 1;
        margin-bottom: 28px;
    }

    .event-footer-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
        padding-top: 20px;
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
        font-size: 0.6rem;
        font-weight: 400;
        color: var(--ink-4);
        letter-spacing: 0.1em;
        text-transform: uppercase;
        margin-bottom: 2px;
    }

    .btn-view {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: var(--font-mono);
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--ink);
        text-decoration: none;
        padding: 11px 22px;
        border: 1px solid var(--line);
        transition: all 0.2s;
        background: transparent;
    }

    .btn-view:hover {
        background: var(--volt-bg);
        color: var(--ink) !important;
        border-color: var(--volt-bg);
    }

    .btn-view i { font-size: 0.7rem; transition: transform 0.2s; }
    .btn-view:hover i { transform: translateX(4px); }

    /* ─── EMPTY STATE ─── */
    .empty-state {
        padding: 80px 40px;
        text-align: center;
        border: 1px solid var(--line);
        background: var(--paper-2);
    }

    .empty-state i { font-size: 3rem; color: var(--ink-4); margin-bottom: 20px; display: block; }

    .empty-state h3 {
        font-family: var(--font-display);
        font-size: 1.8rem;
        color: var(--ink);
        margin-bottom: 10px;
    }

    .empty-state p { color: var(--ink-3); }

    /* ─── STATS BAR ─── */
    .stats-bar {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1px;
        background: var(--line);
        border: 1px solid var(--line);
    }

    .stats-bar-item {
        background: var(--paper-2);
        padding: 36px 40px;
        text-align: center;
    }

    .stats-bar-num {
        font-family: var(--font-display);
        font-size: 2.8rem;
        font-weight: 900;
        color: var(--ink);
        line-height: 1;
    }

    .stats-bar-label {
        font-family: var(--font-mono);
        font-size: 0.62rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--ink-4);
        margin-top: 8px;
    }

    /* ─── CATEGORIES ─── */
    .categories-section {
        padding: 80px 0;
        background: var(--paper-2);
        border-top: 1px solid var(--line);
        border-bottom: 1px solid var(--line);
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1px;
        background: var(--line);
        border: 1px solid var(--line);
    }

    .category-card {
        background: var(--paper-2);
        padding: 44px 36px;
        cursor: pointer;
        transition: background 0.2s;
        position: relative;
        overflow: hidden;
        text-decoration: none;
        display: block;
    }

    .category-card:hover { background: var(--paper-3); }

    .category-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 2px;
        background: var(--volt-bg);
        transform: scaleX(0);
        transition: transform 0.3s ease;
        transform-origin: left;
    }

    .category-card:hover::before { transform: scaleX(1); }

    .category-icon {
        font-size: 2rem;
        color: var(--ink-4);
        margin-bottom: 20px;
        display: block;
        transition: color 0.2s;
    }

    .category-card:hover .category-icon { color: var(--volt); }

    .category-name {
        font-family: var(--font-display);
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 6px;
        letter-spacing: -0.01em;
    }

    .category-sub {
        font-size: 0.8rem;
        color: var(--ink-3);
        font-family: var(--font-mono);
        letter-spacing: 0.05em;
    }

    .category-arrow {
        position: absolute;
        bottom: 28px; right: 28px;
        font-size: 0.7rem;
        color: var(--ink-4);
        transition: color 0.2s, transform 0.2s;
    }

    .category-card:hover .category-arrow { color: var(--volt); transform: translate(4px, -4px); }

    /* ─── BROWSE CTA ─── */
    .browse-cta {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 60px;
    }

    .btn-browse {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-family: var(--font-mono);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--ink);
        text-decoration: none;
        padding: 18px 48px;
        background: var(--volt-bg);
        border: 1px solid transparent;
        transition: background 0.2s, border-color 0.2s;
    }

    .btn-browse:hover { background: #bde82a; color: var(--ink) !important; }

    /* ─── NEWSLETTER ─── */
    .newsletter-section {
        padding: 80px 0;
        background: var(--paper);
    }

    .newsletter-box {
        border: 1px solid var(--line);
        display: grid;
        grid-template-columns: 1fr 1fr;
        overflow: hidden;
    }

    .newsletter-left {
        padding: 60px;
        background: var(--paper-2);
        border-right: 1px solid var(--line);
    }

    .newsletter-right {
        padding: 60px;
        background: var(--paper);
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 16px;
    }

    .newsletter-label {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--volt);
        margin-bottom: 16px;
    }

    .newsletter-title {
        font-family: var(--font-display);
        font-size: 2.4rem;
        font-weight: 900;
        color: var(--ink);
        letter-spacing: -0.02em;
        line-height: 1.1;
        margin-bottom: 16px;
    }

    .newsletter-desc { color: var(--ink-3); font-size: 0.95rem; line-height: 1.65; font-weight: 300; }

    .newsletter-input {
        background: var(--paper-2);
        border: 1px solid var(--line);
        color: var(--ink);
        font-family: var(--font-body);
        font-size: 0.95rem;
        padding: 16px 22px;
        outline: none;
        width: 100%;
        transition: border-color 0.2s, box-shadow 0.2s;
        border-radius: 0;
    }

    .newsletter-input:focus {
        border-color: var(--volt);
        box-shadow: 0 0 0 3px rgba(92,138,0,0.08);
    }

    .newsletter-input::placeholder { color: var(--ink-4); }

    .btn-subscribe {
        background: var(--volt-bg);
        color: var(--ink);
        border: none;
        padding: 16px 36px;
        font-family: var(--font-mono);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.2s;
        align-self: flex-start;
    }

    .btn-subscribe:hover { background: #bde82a; }

    .newsletter-note {
        font-family: var(--font-mono);
        font-size: 0.62rem;
        color: var(--ink-4);
        letter-spacing: 0.08em;
    }

    /* ─── ANIMATIONS ─── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .anim { opacity: 0; }
    .anim.visible { animation: fadeUp 0.65s cubic-bezier(0.2, 0, 0.3, 1) forwards; }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 1024px) {
        .hero-grid { grid-template-columns: 1fr; }
        .hero-right { display: none; }
        .events-grid { grid-template-columns: 1fr 1fr; }
        .event-card.is-featured { grid-column: span 2; }
        .categories-grid { grid-template-columns: repeat(2, 1fr); }
        .newsletter-box { grid-template-columns: 1fr; }
        .newsletter-left { border-right: none; border-bottom: 1px solid var(--line); }
    }

    @media (max-width: 768px) {
        .hero-left { padding: 60px 24px; }
        .hero-title { font-size: 2.8rem; }
        .events-grid { grid-template-columns: 1fr; }
        .event-card.is-featured { grid-column: span 1; flex-direction: column; }
        .featured-right { width: 100%; flex-direction: row; align-items: center; }
        .categories-grid { grid-template-columns: 1fr 1fr; }
        .stats-bar { grid-template-columns: 1fr 1fr; }
        .section-head { flex-direction: column; gap: 12px; }
    }
</style>
@endpush

@section('content')

{{-- ─── HERO ─── --}}
<section class="hero-section">
    <div class="hero-grid">
        <div class="hero-left">
            <div class="hero-eyebrow">Live Events Platform</div>
            <h1 class="hero-title">
                Find Your
                <em>Next Great</em>
                Experience.
            </h1>
            <p class="hero-subtitle">
                Discover concerts, festivals, sports, and culture in your city.
                Book tickets in seconds — no fees, no fuss.
            </p>

            <form action="{{ route('events.search') }}" method="GET" class="search-bar">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search by name, location, or type…"
                    value="{{ request('search') }}"
                    autocomplete="off">
                <button class="btn-search" type="submit">
                    <i class="fas fa-search me-2"></i>Search
                </button>
            </form>
        </div>

        <div class="hero-right">
            <div class="hero-right-bg"></div>
        </div>
    </div>

    <div class="hero-stats">
        <div class="hero-stat">
            <div class="hero-stat-num">500<sup style="font-size:1.2rem; color: var(--volt);">+</sup></div>
            <div class="hero-stat-label">Active Events</div>
        </div>
        <div class="hero-stat" style="border-right: none;">
            <div class="hero-stat-num">50K<sup style="font-size:1.2rem; color: var(--volt);">+</sup></div>
            <div class="hero-stat-label">Tickets Sold</div>
        </div>
    </div>

    <div class="hero-ticker">
        <div class="hero-ticker-inner">
            @for ($i = 0; $i < 2; $i++)
                <span class="ticker-item">Upcoming Events <span class="ticker-dot"></span></span>
                <span class="ticker-item">Book Instantly <span class="ticker-dot"></span></span>
                <span class="ticker-item">No Hidden Fees <span class="ticker-dot"></span></span>
                <span class="ticker-item">Live Music <span class="ticker-dot"></span></span>
                <span class="ticker-item">Sports & More <span class="ticker-dot"></span></span>
                <span class="ticker-item">Arts & Culture <span class="ticker-dot"></span></span>
                <span class="ticker-item">Food Festivals <span class="ticker-dot"></span></span>
                <span class="ticker-item">Find Your Experience <span class="ticker-dot"></span></span>
            @endfor
        </div>
    </div>
</section>

{{-- ─── EVENTS ─── --}}
<section class="events-section">
    <div class="container-fluid px-4 px-lg-5">

        <div class="section-head anim">
            <div>
                <div class="section-label">What's On</div>
                <h2>Upcoming Events</h2>
            </div>
            <a href="{{ route('events.index') }}" class="section-head-link">
                All Events <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        @if($upcomingEvents->isNotEmpty())
            <div class="events-grid">
                @foreach($upcomingEvents as $event)
                    @php $isFeatured = $loop->first; @endphp
                    <div class="event-card {{ $isFeatured ? 'is-featured' : '' }} anim"
                         style="animation-delay: {{ $loop->index * 0.06 }}s">

                        @if($isFeatured)
                            <div class="featured-left">
                                <div class="event-badge-featured"><i class="fas fa-bolt"></i> Editor's Pick</div>
                                <h3 class="event-title">{{ $event->event_name }}</h3>
                                <div class="event-meta">
                                    <div class="event-meta-item">
                                        <i class="fas fa-calendar"></i>
                                        {{ \Carbon\Carbon::parse($event->eventDate)->format('l, F d, Y') }}
                                    </div>
                                    <div class="event-meta-item">
                                        <i class="fas fa-clock"></i>
                                        {{ \Carbon\Carbon::parse($event->eventTime)->format('h:i A') }}
                                    </div>
                                    <div class="event-meta-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ Str::limit($event->location, 45) }}
                                    </div>
                                </div>
                                <p class="event-description">{{ Str::limit($event->description, 160) }}</p>
                            </div>
                            <div class="featured-right">
                                <div class="event-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                                <div>
                                    @if($event->tickets->isNotEmpty())
                                        <div class="event-price">
                                            <span>From</span>
                                            ${{ number_format($event->tickets->min('price'), 2) }}
                                        </div>
                                    @endif
                                    <a href="{{ route('events.show', $event) }}" class="btn-view mt-3">
                                        View <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>

                        @else
                            <div class="event-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                            @if($loop->iteration <= 3)
                                <div class="event-badge-new">New</div>
                            @endif
                            <h3 class="event-title">{{ $event->event_name }}</h3>
                            <div class="event-meta">
                                <div class="event-meta-item">
                                    <i class="fas fa-calendar"></i>
                                    {{ \Carbon\Carbon::parse($event->eventDate)->format('M d, Y') }}
                                </div>
                                <div class="event-meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ Str::limit($event->location, 30) }}
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
                        @endif

                    </div>
                @endforeach
            </div>

            <div class="browse-cta anim">
                <a href="{{ route('events.index') }}" class="btn-browse">
                    <i class="fas fa-calendar-alt"></i> Browse All Events
                </a>
            </div>

        @else
            <div class="empty-state anim">
                <i class="fas fa-calendar-times"></i>
                <h3>No Upcoming Events</h3>
                <p class="mt-2">Check back soon — new events are added daily.</p>
                <a href="{{ route('events.index') }}" class="btn-view mt-4" style="display: inline-flex;">
                    Browse Events <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @endif

    </div>
</section>

{{-- ─── STATS BAR ─── --}}
<div class="container-fluid px-4 px-lg-5 py-0">
    <div class="stats-bar anim">
        <div class="stats-bar-item">
            <div class="stats-bar-num">500+</div>
            <div class="stats-bar-label">Events</div>
        </div>
        <div class="stats-bar-item">
            <div class="stats-bar-num">50K+</div>
            <div class="stats-bar-label">Happy Customers</div>
        </div>
        <div class="stats-bar-item">
            <div class="stats-bar-num">100+</div>
            <div class="stats-bar-label">Cities</div>
        </div>
        <div class="stats-bar-item">
            <div class="stats-bar-num">24/7</div>
            <div class="stats-bar-label">Support</div>
        </div>
    </div>
</div>

{{-- ─── CATEGORIES ─── --}}
<section class="categories-section">
    <div class="container-fluid px-4 px-lg-5">

        <div class="section-head anim">
            <div>
                <div class="section-label">Browse By</div>
                <h2>Event Categories</h2>
            </div>
        </div>

        <div class="categories-grid">
            <a href="{{ route('events.index') }}?category=music" class="category-card anim">
                <i class="fas fa-music category-icon"></i>
                <div class="category-name">Music</div>
                <div class="category-sub">Concerts & Festivals</div>
                <i class="fas fa-arrow-up-right category-arrow"></i>
            </a>
            <a href="{{ route('events.index') }}?category=sports" class="category-card anim" style="animation-delay:0.05s">
                <i class="fas fa-futbol category-icon"></i>
                <div class="category-name">Sports</div>
                <div class="category-sub">Games & Tournaments</div>
                <i class="fas fa-arrow-up-right category-arrow"></i>
            </a>
            <a href="{{ route('events.index') }}?category=arts" class="category-card anim" style="animation-delay:0.1s">
                <i class="fas fa-palette category-icon"></i>
                <div class="category-name">Arts</div>
                <div class="category-sub">Exhibitions & Theatre</div>
                <i class="fas fa-arrow-up-right category-arrow"></i>
            </a>
            <a href="{{ route('events.index') }}?category=food" class="category-card anim" style="animation-delay:0.15s">
                <i class="fas fa-utensils category-icon"></i>
                <div class="category-name">Food</div>
                <div class="category-sub">Festivals & Tastings</div>
                <i class="fas fa-arrow-up-right category-arrow"></i>
            </a>
        </div>

    </div>
</section>

{{-- ─── NEWSLETTER ─── --}}
<section class="newsletter-section">
    <div class="container-fluid px-4 px-lg-5">
        <div class="newsletter-box anim">
            <div class="newsletter-left">
                <div class="newsletter-label">Stay in the Loop</div>
                <h2 class="newsletter-title">Never Miss<br>an Event.</h2>
                <p class="newsletter-desc">
                    Get weekly picks, exclusive pre-sales, and the best events
                    in your city — delivered straight to your inbox.
                </p>
            </div>
            <div class="newsletter-right">
                <input type="email" class="newsletter-input" placeholder="your@email.com">
                <button class="btn-subscribe">Subscribe Now</button>
                <p class="newsletter-note">No spam. Unsubscribe any time.</p>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.anim').forEach(el => observer.observe(el));
</script>
@endpush