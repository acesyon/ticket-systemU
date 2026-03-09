@extends('layouts.app')

@section('title', $event->name . ' — Events')

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

    /* ── BREADCRUMB ── */
    .breadcrumb-bar {
        background: var(--paper-2);
        border-bottom: 1px solid var(--line);
        padding: 14px 0;
        margin-top: -24px;
    }

    .breadcrumb-inner {
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: var(--font-mono);
        font-size: 0.62rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--ink-4);
    }

    .breadcrumb-inner a { color: var(--ink-4); text-decoration: none; transition: color 0.2s; }
    .breadcrumb-inner a:hover { color: var(--volt); }
    .breadcrumb-inner i { font-size: 0.5rem; }
    .breadcrumb-inner .current { color: var(--ink-3); }

    /* ── EVENT HERO ── */
    .event-hero {
        background: var(--paper-2);
        border-bottom: 1px solid var(--line);
        padding: 60px 0 0;
        position: relative;
        overflow: hidden;
    }

    .event-hero-bg {
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 60% 70% at 90% 40%, rgba(92,138,0,0.07) 0%, transparent 65%),
            radial-gradient(ellipse 40% 50% at 5% 90%, rgba(192,57,43,0.04) 0%, transparent 60%);
        pointer-events: none;
    }

    .event-hero-inner {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 60px;
        align-items: start;
    }

    .event-hero-eyebrow {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .event-category-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--volt-bg);
        color: var(--ink);
        font-family: var(--font-mono);
        font-size: 0.58rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        padding: 6px 14px;
    }

    .event-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-family: var(--font-mono);
        font-size: 0.58rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        padding: 6px 14px;
        border: 1px solid;
    }

    .event-status-badge.upcoming  { color: var(--volt);  border-color: var(--volt); }
    .event-status-badge.ongoing   { color: #d97706;       border-color: #d97706; }
    .event-status-badge.completed { color: var(--ink-4); border-color: var(--line); }

    .event-hero h1 {
        font-family: var(--font-display);
        font-size: clamp(2.4rem, 4.5vw, 4.2rem);
        font-weight: 900;
        color: var(--ink);
        letter-spacing: -0.02em;
        line-height: 1.05;
        margin-bottom: 24px;
    }

    .event-meta-strip {
        display: flex;
        flex-wrap: wrap;
        border-top: 1px solid var(--line);
        margin-top: 32px;
    }

    .event-meta-block {
        padding: 22px 32px 22px 0;
        border-right: 1px solid var(--line);
        margin-right: 32px;
        flex-shrink: 0;
    }

    .event-meta-block:last-child { border-right: none; margin-right: 0; }

    .event-meta-label {
        font-family: var(--font-mono);
        font-size: 0.56rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--ink-4);
        margin-bottom: 6px;
    }

    .event-meta-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--ink);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .event-meta-value i { color: var(--volt); font-size: 0.75rem; }

    /* ── TICKET SIDEBAR ── */
    .ticket-sidebar {
        position: sticky;
        top: 24px;
        background: var(--paper);
        border: 1px solid var(--line);
        overflow: hidden;
    }

    .ticket-sidebar-header {
        background: var(--ink);
        color: var(--paper);
        padding: 20px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .ticket-sidebar-header-title {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
    }

    .ticket-sidebar-header-count {
        font-family: var(--font-display);
        font-size: 1.4rem;
        font-weight: 900;
        color: var(--volt-bg);
    }

    /* ── TICKET ITEM ── */
    .ticket-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 28px;
        border-bottom: 1px solid var(--line);
        background: var(--paper);
    }

    .ticket-item-info { flex: 1; }

    .ticket-item-type {
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--ink);
        margin-bottom: 3px;
    }

    .ticket-item-avail {
        font-family: var(--font-mono);
        font-size: 0.56rem;
        letter-spacing: 0.1em;
        color: var(--ink-4);
    }

    .ticket-item-avail.low { color: var(--red-hot); }

    .ticket-item-right { text-align: right; flex-shrink: 0; }

    .ticket-item-price {
        font-family: var(--font-mono);
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--ink);
    }

    .ticket-item-price-label {
        font-size: 0.58rem;
        color: var(--ink-4);
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }

    /* ── TICKET ACTIONS ── */
    .ticket-actions {
        padding: 14px 28px 20px;
        border-bottom: 1px solid var(--line);
        background: var(--paper-2);
    }

    .ticket-actions-qty {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .ticket-actions-qty-label {
        font-family: var(--font-mono);
        font-size: 0.58rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--ink-4);
        flex-shrink: 0;
    }

    .qty-stepper {
        display: flex;
        align-items: center;
        border: 1px solid var(--line);
        background: var(--paper);
        overflow: hidden;
    }

    .qty-btn {
        width: 34px;
        height: 34px;
        background: transparent;
        border: none;
        color: var(--ink-3);
        font-size: 0.75rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.15s, color 0.15s;
        flex-shrink: 0;
    }

    .qty-btn:hover { background: var(--volt-bg); color: var(--ink); }

    .qty-value {
        width: 40px;
        text-align: center;
        border: none;
        border-left: 1px solid var(--line);
        border-right: 1px solid var(--line);
        background: transparent;
        font-family: var(--font-mono);
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--ink);
        padding: 7px 0;
        outline: none;
        -moz-appearance: textfield;
    }

    .qty-value::-webkit-inner-spin-button,
    .qty-value::-webkit-outer-spin-button { -webkit-appearance: none; }

    .ticket-actions-btns {
        display: flex;
        gap: 8px;
    }

    .btn-cart {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        background: var(--volt-bg);
        color: var(--ink);
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        padding: 12px 8px;
        border: none;
        cursor: pointer;
        transition: all 0.18s;
        width: 100%;
    }

    .btn-cart:hover { background: #bde82a; transform: translateY(-1px); }

    .btn-buy {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        background: var(--ink);
        color: var(--paper);
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        padding: 12px 8px;
        border: none;
        cursor: pointer;
        transition: all 0.18s;
        width: 100%;
    }

    .btn-buy:hover { background: var(--ink-2); color: var(--paper); transform: translateY(-1px); }

    .btn-login {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        background: var(--paper-3);
        color: var(--ink-3);
        font-family: var(--font-mono);
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        padding: 13px;
        border: 1px solid var(--line);
        text-decoration: none;
        transition: all 0.18s;
    }

    .btn-login:hover { background: var(--paper-4); color: var(--ink); }

    .ticket-no-tickets {
        padding: 32px 28px;
        text-align: center;
        color: var(--ink-4);
        font-size: 0.85rem;
    }

    .ticket-no-tickets i { font-size: 1.5rem; display: block; margin-bottom: 10px; color: var(--line); }

    /* ── CONTENT SECTION ── */
    .event-content { padding: 56px 0; }

    .event-content-grid {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 60px;
        align-items: start;
    }

    .event-description-block h2 {
        font-family: var(--font-display);
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 20px;
        letter-spacing: -0.01em;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .event-description-block h2::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--line);
    }

    .event-description-text {
        font-size: 1.02rem;
        color: var(--ink-3);
        line-height: 1.75;
        font-weight: 300;
    }

    /* ── INFO PANEL ── */
    .info-panel {
        background: var(--paper-2);
        border: 1px solid var(--line);
        overflow: hidden;
    }

    .info-panel-header {
        background: var(--ink-2);
        color: var(--paper);
        padding: 16px 24px;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        letter-spacing: 0.25em;
        text-transform: uppercase;
    }

    .info-panel-row {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 18px 24px;
        border-bottom: 1px solid var(--line);
    }

    .info-panel-row:last-child { border-bottom: none; }

    .info-panel-icon {
        width: 32px;
        height: 32px;
        background: var(--paper-3);
        border: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: var(--volt);
        font-size: 0.7rem;
    }

    .info-panel-label {
        font-family: var(--font-mono);
        font-size: 0.56rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--ink-4);
        margin-bottom: 4px;
    }

    .info-panel-value {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--ink);
    }

    /* ── BACK BUTTON ── */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: var(--font-mono);
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: var(--ink-4);
        text-decoration: none;
        padding: 10px 0;
        border-bottom: 1px solid transparent;
        transition: all 0.2s;
        margin-top: 28px;
    }

    .btn-back:hover { color: var(--ink); border-bottom-color: var(--line); }
    .btn-back i { font-size: 0.6rem; transition: transform 0.2s; }
    .btn-back:hover i { transform: translateX(-4px); }

    .section-rule { border: none; border-top: 1px solid var(--line); margin: 0; }

    /* ── ANIMATIONS ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .anim { opacity: 0; }
    .anim.visible { animation: fadeUp 0.55s cubic-bezier(0.2,0,0.3,1) forwards; }

    /* ── RESPONSIVE ── */
    @media (max-width: 1024px) {
        .event-hero-inner,
        .event-content-grid { grid-template-columns: 1fr; gap: 40px; }
        .ticket-sidebar { position: static; }
    }

    @media (max-width: 768px) {
        .event-hero { padding: 40px 0 0; }
        .event-meta-strip { flex-direction: column; }
        .event-meta-block { border-right: none; border-bottom: 1px solid var(--line); margin-right: 0; padding: 16px 0; }
        .event-meta-block:last-child { border-bottom: none; }
    }
</style>
@endpush

@section('content')

{{-- ── BREADCRUMB ── --}}
<div class="breadcrumb-bar">
    <div class="container-fluid px-4 px-lg-5">
        <div class="breadcrumb-inner">
            <a href="{{ route('events.index') }}">Events</a>
            <i class="fas fa-chevron-right"></i>
            <span class="current">{{ Str::limit($event->name, 48) }}</span>
        </div>
    </div>
</div>

{{-- ── EVENT HERO ── --}}
<div class="event-hero">
    <div class="event-hero-bg"></div>
    <div class="container-fluid px-4 px-lg-5">
        <div class="event-hero-inner">

            {{-- LEFT: Title + meta --}}
            <div>
                <div class="event-hero-eyebrow anim">
                    @if($event->category)
                        <span class="event-category-badge">
                            <i class="{{ $event->category_icon }}"></i>
                            {{ $event->category }}
                        </span>
                    @endif
                    <span class="event-status-badge {{ $event->status }}">
                        <i class="fas fa-circle" style="font-size:0.45rem;"></i>
                        {{ ucfirst($event->status) }}
                    </span>
                </div>

                <h1 class="anim" style="animation-delay:0.07s">{{ $event->name }}</h1>

                <div class="event-meta-strip anim" style="animation-delay:0.14s">
                    <div class="event-meta-block">
                        <div class="event-meta-label">Date</div>
                        <div class="event-meta-value">
                            <i class="fas fa-calendar"></i>
                            {{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y') }}
                        </div>
                    </div>
                    <div class="event-meta-block">
                        <div class="event-meta-label">Time</div>
                        <div class="event-meta-value">
                            <i class="fas fa-clock"></i>
                            {{ \Carbon\Carbon::parse($event->time)->format('g:i A') }}
                        </div>
                    </div>
                    <div class="event-meta-block">
                        <div class="event-meta-label">Location</div>
                        <div class="event-meta-value">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $event->location }}
                        </div>
                    </div>
                    @if($event->tickets->isNotEmpty())
                        <div class="event-meta-block">
                            <div class="event-meta-label">From</div>
                            <div class="event-meta-value">
                                <i class="fas fa-ticket-alt"></i>
                                ${{ number_format($event->tickets->min('price'), 2) }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- RIGHT: Ticket sidebar --}}
            <div class="ticket-sidebar anim" style="animation-delay:0.2s">
                <div class="ticket-sidebar-header">
                    <div class="ticket-sidebar-header-title">Tickets</div>
                    <div class="ticket-sidebar-header-count">{{ $event->tickets->count() }}</div>
                </div>

                @if($event->tickets->isNotEmpty())
                    @foreach($event->tickets as $ticket)

                        {{-- Ticket info --}}
                        <div class="ticket-item">
                            <div class="ticket-item-info">
                                <div class="ticket-item-type">{{ $ticket->ticket_type ?? 'General Admission' }}</div>
                                @if($ticket->quantity_available)
                                    <div class="ticket-item-avail {{ $ticket->quantity_available < 20 ? 'low' : '' }}">
                                        {{ $ticket->quantity_available < 20
                                            ? 'Only ' . $ticket->quantity_available . ' left!'
                                            : $ticket->quantity_available . ' available' }}
                                    </div>
                                @endif
                            </div>
                            <div class="ticket-item-right">
                                <div class="ticket-item-price-label">Price</div>
                                <div class="ticket-item-price">${{ number_format($ticket->price, 2) }}</div>
                            </div>
                        </div>

                        {{-- Qty + buttons --}}
                        <div class="ticket-actions">
                            @auth
                                <div class="ticket-actions-qty">
                                    <span class="ticket-actions-qty-label">Qty</span>
                                    <div class="qty-stepper">
                                        <button type="button" class="qty-btn" onclick="changeQty(this, -1)" aria-label="Decrease">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" class="qty-value" value="1" min="1" max="{{ $ticket->quantity_available ?? 99 }}" readonly>
                                        <button type="button" class="qty-btn" onclick="changeQty(this, 1)" aria-label="Increase">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="ticket-actions-btns">
                                    <form action="{{ route('cart.add', $ticket) }}" method="POST" style="flex:1; display:flex;">
                                        @csrf
                                        <input type="hidden" name="quantity" class="qty-hidden" value="1">
                                        <button type="submit" class="btn-cart">
                                            <i class="fas fa-shopping-cart"></i> Add to Cart
                                        </button>
                                    </form>
                                    <form action="{{ route('cart.add', $ticket) }}" method="POST" style="flex:1; display:flex;">
                                        @csrf
                                        <input type="hidden" name="quantity" class="qty-hidden" value="1">
                                        <input type="hidden" name="redirect" value="checkout">
                                        <button type="submit" class="btn-buy">
                                            <i class="fas fa-bolt"></i> Buy Ticket
                                        </button>
                                    </form>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="btn-login">
                                    <i class="fas fa-lock"></i> Login to Purchase
                                </a>
                            @endauth
                        </div>

                    @endforeach
                @else
                    <div class="ticket-no-tickets">
                        <i class="fas fa-ticket-alt"></i>
                        No tickets available at this time.
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

<hr class="section-rule">

{{-- ── MAIN CONTENT ── --}}
<div class="event-content">
    <div class="container-fluid px-4 px-lg-5">
        <div class="event-content-grid">

            {{-- Description --}}
            <div class="event-description-block anim">
                <h2>About this Event</h2>
                <div class="event-description-text">
                    {!! nl2br(e($event->description ?? 'No description provided for this event.')) !!}
                </div>
            </div>

            {{-- Info panel --}}
            <div class="anim" style="animation-delay:0.1s">
                <div class="info-panel">
                    <div class="info-panel-header">Event Details</div>
                    <div>
                        <div class="info-panel-row">
                            <div class="info-panel-icon"><i class="fas fa-calendar"></i></div>
                            <div>
                                <div class="info-panel-label">Date</div>
                                <div class="info-panel-value">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</div>
                            </div>
                        </div>
                        <div class="info-panel-row">
                            <div class="info-panel-icon"><i class="fas fa-clock"></i></div>
                            <div>
                                <div class="info-panel-label">Time</div>
                                <div class="info-panel-value">{{ \Carbon\Carbon::parse($event->time)->format('g:i A') }}</div>
                            </div>
                        </div>
                        <div class="info-panel-row">
                            <div class="info-panel-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <div class="info-panel-label">Location</div>
                                <div class="info-panel-value">{{ $event->location }}</div>
                            </div>
                        </div>
                        @if($event->category)
                            <div class="info-panel-row">
                                <div class="info-panel-icon"><i class="{{ $event->category_icon }}"></i></div>
                                <div>
                                    <div class="info-panel-label">Category</div>
                                    <div class="info-panel-value">{{ $event->category }}</div>
                                </div>
                            </div>
                        @endif
                        <div class="info-panel-row">
                            <div class="info-panel-icon"><i class="fas fa-tag"></i></div>
                            <div>
                                <div class="info-panel-label">Status</div>
                                <div class="info-panel-value" style="text-transform:capitalize;">{{ $event->status }}</div>
                            </div>
                        </div>
                        @if($event->creator)
                            <div class="info-panel-row">
                                <div class="info-panel-icon"><i class="fas fa-user"></i></div>
                                <div>
                                    <div class="info-panel-label">Organized by</div>
                                    <div class="info-panel-value">{{ $event->creator->name }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <a href="{{ route('events.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to All Events
                </a>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Fade-up animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.06, rootMargin: '0px 0px -30px 0px' });

    document.querySelectorAll('.anim').forEach(el => observer.observe(el));

    // Qty stepper: updates the display value and syncs both hidden qty fields
    function changeQty(btn, delta) {
        const stepper = btn.closest('.qty-stepper');
        const input   = stepper.querySelector('.qty-value');
        const max     = parseInt(input.max) || 99;
        const min     = parseInt(input.min) || 1;
        let val = parseInt(input.value) + delta;
        if (val < min) val = min;
        if (val > max) val = max;
        input.value = val;

        // Sync all hidden qty fields in this ticket-actions block
        const actions = btn.closest('.ticket-actions');
        actions.querySelectorAll('.qty-hidden').forEach(h => h.value = val);
    }
</script>
@endpush
