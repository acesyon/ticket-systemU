@extends('layouts.app')

@section('title', $event->name . ' — Events')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,600;0,9..144,700;1,9..144,300&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* ══════════════════════════════════════════════════════
   TOKENS
══════════════════════════════════════════════════════ */
:root {
    --ink:        #0d0d0d;
    --ink-2:      #1c1c1c;
    --ink-3:      #2e2e2e;
    --mist:       #f7f6f3;
    --mist-2:     #efede8;
    --border:     #e3e0d8;
    --white:      #ffffff;
    --text-body:  #4a4742;
    --text-muted: #8c8882;
    --gold:       #c9a84c;
    --gold-light: #e8c96a;
    --gold-soft:  #f5edd8;
    --success:    #2d7a5f;
    --success-bg: #d1fae5;
    --warning:    #b45309;
    --warning-bg: #fef3c7;
    --error:      #c0392b;

    --f-display: 'Fraunces', Georgia, serif;
    --f-body:    'DM Sans', sans-serif;

    --r-sm: 4px;
    --r-md: 8px;
    --r-lg: 14px;
    --r-xl: 20px;

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
   BREADCRUMB
══════════════════════════════════════════════════════ */
.breadcrumb-bar {
    background: var(--ink);
    border-bottom: 1px solid rgba(255,255,255,0.08);
    padding: 14px 0;
}

.breadcrumb-list {
    display: flex;
    align-items: center;
    gap: 8px;
    list-style: none;
    font-size: 13px;
    flex-wrap: wrap;
}

.breadcrumb-list a {
    color: rgba(255,255,255,0.4);
    text-decoration: none;
    transition: color 0.2s;
}

.breadcrumb-list a:hover { color: var(--gold); }

.breadcrumb-sep { color: rgba(255,255,255,0.2); font-size: 11px; }

.breadcrumb-current {
    color: rgba(255,255,255,0.7);
    font-weight: 500;
    overflow-wrap: anywhere;
}

/* ══════════════════════════════════════════════════════
   EVENT HERO — dark full-width header
══════════════════════════════════════════════════════ */
.event-hero {
    background: var(--ink);
    padding: 60px 0 56px;
    position: relative;
    overflow: hidden;
}

.event-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
    background-size: 28px 28px;
    pointer-events: none;
}

/* Category-coloured accent line */
.event-hero-accent {
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
}

.event-hero-inner {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 60px;
    align-items: start;
}

/* Left — title / meta */
.event-hero-left {}

.event-hero-chips {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 24px;
}

.chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-family: var(--f-body);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    padding: 5px 12px;
    border-radius: 4px;
}

.chip-cat {
    background: rgba(201,168,76,0.18);
    color: var(--gold);
    border: 1px solid rgba(201,168,76,0.3);
}

.chip-cat i { color: var(--gold); }

.chip-upcoming  { background: rgba(29,78,216,0.18);  color: #93c5fd; border: 1px solid rgba(29,78,216,0.3); }
.chip-ongoing   { background: rgba(6,95,70,0.25);    color: #6ee7b7; border: 1px solid rgba(6,95,70,0.4); }
.chip-completed { background: rgba(75,85,99,0.25);   color: #9ca3af; border: 1px solid rgba(75,85,99,0.3); }

.event-hero-title {
    font-family: var(--f-display);
    font-size: clamp(36px, 4.5vw, 58px);
    font-weight: 600;
    line-height: 1.08;
    letter-spacing: -0.03em;
    color: var(--white);
    margin-bottom: 36px;
}

/* Meta grid */
.event-hero-meta {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.meta-block {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.meta-icon {
    width: 42px;
    height: 42px;
    border-radius: var(--r-md);
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: var(--gold);
    flex-shrink: 0;
}

.meta-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.35);
    margin-bottom: 4px;
}

.meta-value {
    font-family: var(--f-display);
    font-size: 17px;
    font-weight: 600;
    color: var(--white);
    line-height: 1.2;
}

/* ── Right — Ticket sidebar ── */
.ticket-sidebar {
    background: var(--white);
    border-radius: var(--r-xl);
    overflow: hidden;
    box-shadow: var(--shadow-lift);
    position: sticky;
    top: 24px;
}

.ts-head {
    background: var(--ink-2);
    padding: 22px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid rgba(255,255,255,0.06);
}

.ts-head-title {
    font-family: var(--f-display);
    font-size: 18px;
    font-weight: 600;
    color: var(--white);
}

.ts-head-count {
    font-family: var(--f-display);
    font-size: 26px;
    font-weight: 600;
    color: var(--gold);
    line-height: 1;
}

/* Past event banner */
.ts-past-banner {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 18px 28px;
    background: #fef3c7;
    border-bottom: 1px solid #fcd34d;
}

.ts-past-banner i {
    font-size: 18px;
    color: var(--warning);
    flex-shrink: 0;
}

.ts-past-banner p {
    font-size: 13px;
    color: var(--warning);
    font-weight: 500;
    line-height: 1.4;
}

/* Ticket items */
.ts-list { max-height: 440px; overflow-y: auto; }

.ts-item {
    padding: 22px 28px;
    border-bottom: 1px solid var(--border);
    background: var(--white);
}

.ts-item:last-child { border-bottom: none; }

.ts-item-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 10px;
}

.ts-ticket-name {
    font-family: var(--f-display);
    font-size: 17px;
    font-weight: 600;
    color: var(--ink);
    line-height: 1.2;
}

.ts-ticket-price {
    font-family: var(--f-display);
    font-size: 22px;
    font-weight: 600;
    color: var(--ink);
    line-height: 1;
    white-space: nowrap;
}

.ts-ticket-price sup {
    font-family: var(--f-body);
    font-size: 13px;
    font-weight: 500;
    color: var(--text-muted);
    vertical-align: super;
}

/* Availability */
.ts-avail {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 3px;
    margin-bottom: 16px;
}

.ts-avail.ok   { background: var(--success-bg); color: var(--success); }
.ts-avail.low  { background: #fee2e2; color: #991b1b; }
.ts-avail i    { font-size: 11px; }

/* Qty selector */
.ts-qty {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 14px;
}

.ts-qty-label {
    font-size: 13px;
    font-weight: 500;
    color: var(--text-muted);
}

.qty-controls {
    display: flex;
    align-items: center;
    border: 1px solid var(--border);
    border-radius: var(--r-sm);
    overflow: hidden;
}

.qty-btn {
    width: 36px;
    height: 36px;
    background: var(--mist);
    border: none;
    font-size: 14px;
    color: var(--text-body);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.qty-btn:hover:not(:disabled) { background: var(--gold-soft); color: var(--ink); }
.qty-btn:disabled { opacity: 0.4; cursor: not-allowed; }

.qty-input {
    width: 48px;
    height: 36px;
    border: none;
    border-left: 1px solid var(--border);
    border-right: 1px solid var(--border);
    text-align: center;
    font-family: var(--f-body);
    font-size: 15px;
    font-weight: 600;
    color: var(--ink);
    background: var(--white);
    -moz-appearance: textfield;
    outline: none;
}

.qty-input::-webkit-inner-spin-button,
.qty-input::-webkit-outer-spin-button { -webkit-appearance: none; }

/* Action buttons */
.ts-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.btn-cart {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 16px;
    background: var(--mist);
    border: 1px solid var(--border);
    border-radius: var(--r-md);
    font-family: var(--f-body);
    font-size: 13px;
    font-weight: 600;
    color: var(--ink);
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-cart:hover {
    border-color: var(--ink);
    background: var(--mist-2);
    color: var(--ink);
}

.btn-buy {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 16px;
    background: var(--gold);
    border: none;
    border-radius: var(--r-md);
    font-family: var(--f-body);
    font-size: 13px;
    font-weight: 700;
    color: var(--ink);
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-buy:hover {
    background: var(--gold-light);
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(201,168,76,0.3);
    color: var(--ink);
}

/* Login prompt */
.ts-login {
    padding: 20px 28px;
    border-top: 1px solid var(--border);
}

.btn-login {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    width: 100%;
    padding: 14px 20px;
    background: var(--ink);
    border-radius: var(--r-md);
    font-family: var(--f-body);
    font-size: 14px;
    font-weight: 600;
    color: var(--white);
    text-decoration: none;
    transition: all 0.2s;
}

.btn-login:hover {
    background: var(--gold);
    color: var(--ink);
}

/* No tickets */
.ts-empty {
    padding: 48px 28px;
    text-align: center;
}

.ts-empty i {
    font-size: 40px;
    color: var(--border);
    margin-bottom: 14px;
    display: block;
}

.ts-empty p {
    font-size: 14px;
    color: var(--text-muted);
    line-height: 1.5;
}

/* ══════════════════════════════════════════════════════
   MAIN CONTENT AREA
══════════════════════════════════════════════════════ */
.content-wrap {
    padding: 60px 0 100px;
}

.content-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 60px;
    align-items: start;
}

/* About section */
.about-section {}

.section-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 14px;
}

.section-eyebrow::before {
    content: '';
    display: block;
    width: 16px; height: 1px;
    background: var(--gold);
}

.about-title {
    font-family: var(--f-display);
    font-size: 30px;
    font-weight: 600;
    letter-spacing: -0.025em;
    color: var(--ink);
    margin-bottom: 24px;
}

.about-body {
    font-size: 16px;
    color: var(--text-body);
    line-height: 1.8;
}

.about-body p { margin-bottom: 18px; }
.about-body p:last-child { margin-bottom: 0; }

/* Back link */
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 36px;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-muted);
    text-decoration: none;
    transition: all 0.2s;
}

.back-link i { transition: transform 0.2s; }

.back-link:hover {
    color: var(--gold);
}

.back-link:hover i { transform: translateX(-4px); }

/* Info panel */
.info-panel {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    position: sticky;
    top: 24px;
}

.info-panel-head {
    background: var(--ink);
    padding: 20px 28px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.info-panel-head-title {
    font-family: var(--f-display);
    font-size: 17px;
    font-weight: 600;
    color: var(--white);
}

.info-panel-head i { color: var(--gold); font-size: 16px; }

.info-rows {}

.info-row {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 18px 28px;
    border-bottom: 1px solid var(--border);
}

.info-row:last-child { border-bottom: none; }

.info-row-icon {
    width: 38px;
    height: 38px;
    background: var(--gold-soft);
    border-radius: var(--r-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    color: #8a6a1a;
    flex-shrink: 0;
}

.info-row-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 3px;
}

.info-row-value {
    font-size: 15px;
    font-weight: 600;
    color: var(--ink);
    line-height: 1.3;
}

.info-row-value.status-upcoming  { color: #1d4ed8; }
.info-row-value.status-ongoing   { color: var(--success); }
.info-row-value.status-completed { color: var(--text-muted); }

/* ══════════════════════════════════════════════════════
   ANIMATIONS
══════════════════════════════════════════════════════ */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

.fade-up {
    opacity: 0;
    animation: fadeUp 0.55s cubic-bezier(0.22, 1, 0.36, 1) forwards;
}

/* ══════════════════════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════════════════════ */
@media (max-width: 1024px) {
    .event-hero-inner,
    .content-grid { grid-template-columns: 1fr; gap: 40px; }
    .ticket-sidebar { position: static; max-width: 560px; }
    .info-panel { position: static; }
    .event-hero-meta { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 768px) {
    .wrap { padding: 0 20px; }
    .event-hero { padding: 44px 0 40px; }
    .breadcrumb-list { font-size: 12px; gap: 6px; }
    .event-hero-meta { grid-template-columns: 1fr; gap: 14px; }
    .ts-actions { grid-template-columns: 1fr; }
    .content-wrap { padding: 40px 0 70px; }
}
</style>
@endpush

@section('content')

{{-- ══ BREADCRUMB ═══════════════════════════════════════ --}}
<div class="breadcrumb-bar">
    <div class="wrap">
        <ul class="breadcrumb-list">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-sep"><i class="bi bi-chevron-right"></i></li>
            <li><a href="{{ route('events.index') }}">Events</a></li>
            <li class="breadcrumb-sep"><i class="bi bi-chevron-right"></i></li>
            <li class="breadcrumb-current">{{ Str::limit($event->name, 42) }}</li>
        </ul>
    </div>
</div>

{{-- ══ EVENT HERO ═══════════════════════════════════════ --}}
@php
    // Pull accent color directly from Event::categories() — single source of truth
    $accentColor = $event->category_color;
@endphp

<div class="event-hero">
    <div class="event-hero-accent" style="background: linear-gradient(90deg, transparent, {{ $accentColor }}, transparent);"></div>

    <div class="wrap">
        <div class="event-hero-inner">

            {{-- Left: title + meta --}}
            <div class="event-hero-left fade-up">

                <div class="event-hero-chips">
                    @if($event->category)
                        <span class="chip chip-cat">
                            <i class="{{ $event->category_icon }}"></i>
                            {{ $event->category }}
                        </span>
                    @endif
                    <span class="chip chip-{{ $event->live_status }}">
                        @if($event->live_status === 'upcoming')
                            <i class="bi bi-clock"></i> Upcoming
                        @elseif($event->live_status === 'ongoing')
                            <i class="bi bi-record-circle-fill"></i> Ongoing
                        @elseif($event->live_status === 'completed')
                            <i class="bi bi-check-circle"></i> Completed
                        @endif
                    </span>
                </div>

                <h1 class="event-hero-title">{{ $event->name }}</h1>

                <div class="event-hero-meta">
                    <div class="meta-block">
                        <div class="meta-icon"><i class="bi bi-calendar3"></i></div>
                        <div>
                            <div class="meta-label">Date</div>
                            <div class="meta-value">{{ $event->date->format('l, F j, Y') }}</div>
                        </div>
                    </div>

                    <div class="meta-block">
                        <div class="meta-icon"><i class="bi bi-clock"></i></div>
                        <div>
                            <div class="meta-label">Time</div>
                            <div class="meta-value">{{ $event->formatted_time }}</div>
                        </div>
                    </div>

                    <div class="meta-block">
                        <div class="meta-icon"><i class="bi bi-geo-alt"></i></div>
                        <div>
                            <div class="meta-label">Location</div>
                            <div class="meta-value">{{ $event->location }}</div>
                        </div>
                    </div>

                    <div class="meta-block">
                        <div class="meta-icon"><i class="bi bi-ticket-perforated"></i></div>
                        <div>
                            <div class="meta-label">Starting from</div>
                            @if($event->tickets->isNotEmpty() && $event->min_price !== null)
                                <div class="meta-value">${{ number_format($event->min_price, 2) }}</div>
                            @elseif($event->tickets->isNotEmpty())
                                <div class="meta-value">Free</div>
                            @else
                                <div class="meta-value" style="font-size:14px; color:rgba(255,255,255,0.35);">Not available</div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            {{-- Right: ticket sidebar --}}
            <div class="ticket-sidebar fade-up" style="animation-delay:0.15s">

                <div class="ts-head">
                    <span class="ts-head-title">Tickets</span>
                    <span class="ts-head-count">{{ $event->tickets->count() }}</span>
                </div>

                @if($event->tickets->isNotEmpty())
                    <div class="ts-list">
                        @foreach($event->tickets as $ticket)
                            <div class="ts-item">

                                <div class="ts-item-top">
                                    <div class="ts-ticket-name">
                                        {{ $ticket->ticket_type ?? 'General Admission' }}
                                    </div>
                                    <div class="ts-ticket-price">
                                        <sup>$</sup>{{ number_format($ticket->price, 2) }}
                                    </div>
                                </div>

                                @if(isset($ticket->quantity_available))
                                    <div class="ts-avail {{ $ticket->quantity_available < 20 ? 'low' : 'ok' }}">
                                        @if($ticket->quantity_available < 20)
                                            <i class="bi bi-exclamation-triangle-fill"></i>
                                            Only {{ $ticket->quantity_available }} left!
                                        @else
                                            <i class="bi bi-check-circle-fill"></i>
                                            {{ $ticket->quantity_available }} available
                                        @endif
                                    </div>
                                @endif

                                @auth
                                    <form action="{{ route('cart.add', $ticket) }}" method="POST">
                                        @csrf
                                        <div class="ts-qty">
                                            <span class="ts-qty-label">Qty</span>
                                            <div class="qty-controls">
                                                <button type="button" class="qty-btn" onclick="decrementQty(this)"
                                                    {{ ($ticket->quantity_available ?? 1) < 1 ? 'disabled' : '' }}>
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                                <input type="number" name="quantity" class="qty-input"
                                                    value="1" min="1"
                                                    max="{{ $ticket->quantity_available ?? 99 }}"
                                                    readonly>
                                                <button type="button" class="qty-btn" onclick="incrementQty(this)"
                                                    {{ ($ticket->quantity_available ?? 1) < 1 ? 'disabled' : '' }}>
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="ts-actions">
                                            <button type="submit" name="action" value="cart" class="btn-cart">
                                                <i class="bi bi-cart3"></i>
                                                Add to Cart
                                            </button>
                                            <button type="submit" name="action" value="checkout" class="btn-buy">
                                                <i class="bi bi-lightning-charge-fill"></i>
                                                Buy Now
                                            </button>
                                        </div>
                                    </form>
                                @endauth

                            </div>
                        @endforeach
                    </div>

                    @guest
                        <div class="ts-login">
                            <a href="{{ route('login') }}" class="btn-login">
                                <i class="bi bi-box-arrow-in-right"></i>
                                Log in to purchase tickets
                            </a>
                        </div>
                    @endguest

                @else
                    <div class="ts-empty">
                        <i class="bi bi-ticket"></i>
                        <p>No tickets available at this time.</p>
                    </div>
                @endif

            </div>

        </div>
    </div>
</div>

{{-- ══ CONTENT ══════════════════════════════════════════ --}}
<div class="content-wrap">
    <div class="wrap">
        <div class="content-grid">

            {{-- About --}}
            <div class="about-section fade-up">
                <div class="section-eyebrow">About This Event</div>
                <h2 class="about-title">What to expect</h2>
                <div class="about-body">
                    {!! nl2br(e($event->description ?? 'No description has been provided for this event.')) !!}
                </div>

                <a href="{{ route('events.index') }}" class="back-link">
                    <i class="bi bi-arrow-left"></i>
                    Back to all events
                </a>
            </div>

            {{-- Info panel --}}
            <div class="fade-up" style="animation-delay:0.1s">
                <div class="info-panel">
                    <div class="info-panel-head">
                        <i class="bi bi-info-circle"></i>
                        <span class="info-panel-head-title">Event Details</span>
                    </div>

                    <div class="info-rows">
                        <div class="info-row">
                            <div class="info-row-icon"><i class="bi bi-calendar3"></i></div>
                            <div>
                                <div class="info-row-label">Date</div>
                                <div class="info-row-value">{{ $event->date->format('l, F j, Y') }}</div>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-row-icon"><i class="bi bi-clock"></i></div>
                            <div>
                                <div class="info-row-label">Time</div>
                                <div class="info-row-value">{{ $event->formatted_time }}</div>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-row-icon"><i class="bi bi-geo-alt"></i></div>
                            <div>
                                <div class="info-row-label">Location</div>
                                <div class="info-row-value">{{ $event->location }}</div>
                            </div>
                        </div>

                        @if($event->category)
                        <div class="info-row">
                            <div class="info-row-icon"><i class="{{ $event->category_icon }}"></i></div>
                            <div>
                                <div class="info-row-label">Category</div>
                                <div class="info-row-value">{{ $event->category }}</div>
                            </div>
                        </div>
                        @endif

                        <div class="info-row">
                            <div class="info-row-icon"><i class="bi bi-tag"></i></div>
                            <div>
                                <div class="info-row-label">Status</div>
                                <div class="info-row-value status-{{ $event->live_status }}">
                                    {{ ucfirst($event->live_status) }}
                                </div>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-row-icon"><i class="bi bi-ticket-perforated"></i></div>
                            <div>
                                <div class="info-row-label">Ticket Price</div>
                                <div class="info-row-value">
                                    @if($event->tickets->isNotEmpty() && $event->min_price !== null)
                                        From ${{ number_format($event->min_price, 2) }}
                                    @elseif($event->tickets->isNotEmpty())
                                        Free Admission
                                    @else
                                        Not Available
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($event->creator)
                        <div class="info-row">
                            <div class="info-row-icon"><i class="bi bi-person"></i></div>
                            <div>
                                <div class="info-row-label">Organized by</div>
                                <div class="info-row-value">{{ $event->creator->name }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Staggered animations
const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animationPlayState = 'running';
            io.unobserve(entry.target);
        }
    });
}, { threshold: 0.07 });

document.querySelectorAll('.fade-up').forEach(el => {
    el.style.animationPlayState = 'paused';
    io.observe(el);
});

// Quantity controls
function incrementQty(btn) {
    const input = btn.closest('.qty-controls').querySelector('.qty-input');
    const max = parseInt(input.max) || 99;
    const val = parseInt(input.value);
    if (val < max) input.value = val + 1;
}

function decrementQty(btn) {
    const input = btn.closest('.qty-controls').querySelector('.qty-input');
    const min = parseInt(input.min) || 1;
    const val = parseInt(input.value);
    if (val > min) input.value = val - 1;
}
</script>
@endpush