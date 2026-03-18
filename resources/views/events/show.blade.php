@extends('layouts.app')

@section('title', $event->name . ' — Events')

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

    /* Breadcrumb */
    .breadcrumb {
        padding: 20px 0;
        border-bottom: 1px solid var(--border);
        background: var(--white);
    }

    .breadcrumb-list {
        display: flex;
        align-items: center;
        gap: 8px;
        list-style: none;
        font-size: 14px;
    }

    .breadcrumb-item a {
        color: var(--text-tertiary);
        text-decoration: none;
        transition: color 0.2s;
    }

    .breadcrumb-item a:hover {
        color: var(--accent);
    }

    .breadcrumb-item.active {
        color: var(--text-primary);
        font-weight: 500;
    }

    .breadcrumb-separator {
        color: var(--border);
        font-size: 12px;
    }

    /* Event Hero */
    .event-hero {
        padding: 48px 0 40px;
        background: linear-gradient(to bottom, var(--white), var(--off-white));
        border-bottom: 1px solid var(--border);
    }

    .event-hero-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 48px;
        align-items: start;
    }

    /* Event Badges */
    .event-badges {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .event-category {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        background: var(--accent-soft);
        color: var(--accent);
        border-radius: 100px;
        font-size: 14px;
        font-weight: 500;
    }

    .event-category i {
        font-size: 14px;
    }

    .event-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 16px;
        border-radius: 100px;
        font-size: 13px;
        font-weight: 500;
    }

    .event-status.upcoming {
        background: #e6f7e6;
        color: var(--success);
    }

    .event-status.ongoing {
        background: #fff3e0;
        color: var(--warning);
    }

    .event-status.completed {
        background: var(--light-gray);
        color: var(--text-tertiary);
    }

    .event-status i {
        font-size: 8px;
    }

    /* Event Title */
    .event-title {
        font-size: clamp(32px, 4vw, 48px);
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 24px;
        color: var(--text-primary);
    }

    /* Event Meta Grid */
    .event-meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 24px;
        margin-top: 32px;
    }

    .event-meta-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .event-meta-icon {
        width: 40px;
        height: 40px;
        background: var(--off-white);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        font-size: 18px;
        flex-shrink: 0;
    }

    .event-meta-content {
        flex: 1;
    }

    .event-meta-label {
        font-size: 13px;
        color: var(--text-tertiary);
        margin-bottom: 4px;
    }

    .event-meta-value {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
    }

    /* Ticket Sidebar */
    .ticket-sidebar {
        position: sticky;
        top: 24px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .ticket-header {
        padding: 20px 24px;
        background: var(--text-primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .ticket-header-title {
        font-size: 16px;
        font-weight: 600;
        letter-spacing: -0.01em;
    }

    .ticket-header-count {
        font-size: 24px;
        font-weight: 700;
        color: var(--accent-soft);
    }

    /* Ticket Items */
    .ticket-list {
        max-height: 400px;
        overflow-y: auto;
    }

    .ticket-item {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border);
        background: var(--white);
    }

    .ticket-item:last-child {
        border-bottom: none;
    }

    .ticket-item-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .ticket-type {
        font-weight: 600;
        font-size: 16px;
        color: var(--text-primary);
    }

    .ticket-price {
        font-weight: 700;
        font-size: 18px;
        color: var(--text-primary);
    }

    .ticket-price small {
        font-size: 13px;
        font-weight: 400;
        color: var(--text-tertiary);
        margin-right: 4px;
    }

    .ticket-availability {
        font-size: 13px;
        color: var(--text-secondary);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .ticket-availability.low {
        color: var(--error);
    }

    .ticket-availability i {
        font-size: 12px;
    }

    /* Quantity Selector */
    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 16px 0;
    }

    .quantity-label {
        font-size: 14px;
        color: var(--text-secondary);
        font-weight: 500;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        overflow: hidden;
    }

    .quantity-btn {
        width: 36px;
        height: 36px;
        background: var(--white);
        border: none;
        color: var(--text-secondary);
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .quantity-btn:hover:not(:disabled) {
        background: var(--off-white);
        color: var(--accent);
    }

    .quantity-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .quantity-input {
        width: 50px;
        height: 36px;
        border: none;
        border-left: 1px solid var(--border);
        border-right: 1px solid var(--border);
        text-align: center;
        font-weight: 600;
        font-size: 14px;
        color: var(--text-primary);
        background: var(--white);
        -moz-appearance: textfield;
    }

    .quantity-input::-webkit-inner-spin-button,
    .quantity-input::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Ticket Actions */
    .ticket-actions {
        display: flex;
        gap: 10px;
        margin-top: 16px;
    }

    .btn-primary {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 20px;
        background: var(--accent);
        color: white;
        border: none;
        border-radius: var(--radius-sm);
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-primary:hover {
        background: var(--accent-light);
        transform: translateY(-1px);
    }

    .btn-outline {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 20px;
        background: var(--white);
        color: var(--text-primary);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-outline:hover {
        border-color: var(--accent);
        color: var(--accent);
        background: var(--accent-soft);
    }

    .btn-block {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 14px 24px;
        background: var(--off-white);
        color: var(--text-secondary);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        font-weight: 500;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-block:hover {
        background: var(--light-gray);
        color: var(--text-primary);
    }

    /* Empty State */
    .ticket-empty {
        padding: 48px 24px;
        text-align: center;
        color: var(--text-tertiary);
    }

    .ticket-empty i {
        font-size: 40px;
        margin-bottom: 16px;
        color: var(--border);
    }

    .ticket-empty p {
        font-size: 15px;
    }

    /* Content Section */
    .content-section {
        padding: 60px 0;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 48px;
        align-items: start;
    }

    /* Description */
    .description h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 24px;
        color: var(--text-primary);
    }

    .description-text {
        color: var(--text-secondary);
        font-size: 16px;
        line-height: 1.8;
    }

    .description-text p {
        margin-bottom: 20px;
    }

    /* Info Panel */
    .info-panel {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
    }

    .info-panel-header {
        padding: 16px 24px;
        background: var(--off-white);
        border-bottom: 1px solid var(--border);
        font-weight: 600;
        font-size: 16px;
        color: var(--text-primary);
    }

    .info-panel-body {
        padding: 8px 0;
    }

    .info-row {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 16px 24px;
        border-bottom: 1px solid var(--border);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-icon {
        width: 36px;
        height: 36px;
        background: var(--off-white);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        font-size: 16px;
        flex-shrink: 0;
    }

    .info-content {
        flex: 1;
    }

    .info-label {
        font-size: 13px;
        color: var(--text-tertiary);
        margin-bottom: 4px;
    }

    .info-value {
        font-size: 15px;
        font-weight: 500;
        color: var(--text-primary);
    }

    /* Back Button */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 32px;
        padding: 8px 0;
        color: var(--text-tertiary);
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: var(--accent);
    }

    .back-link i {
        font-size: 14px;
        transition: transform 0.2s;
    }

    .back-link:hover i {
        transform: translateX(-4px);
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
        .event-hero-grid,
        .content-grid {
            grid-template-columns: 1fr;
            gap: 32px;
        }

        .ticket-sidebar {
            position: static;
            max-width: 500px;
            margin: 0 auto;
        }
    }

    @media (max-width: 768px) {
        .container-custom {
            padding: 0 20px;
        }

        .event-hero {
            padding: 32px 0;
        }

        .event-title {
            font-size: 28px;
        }

        .event-meta-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .ticket-list {
            max-height: none;
        }

        .ticket-actions {
            flex-direction: column;
        }

        .content-section {
            padding: 40px 0;
        }
    }
</style>
@endpush

@section('content')
{{-- Breadcrumb --}}
<div class="breadcrumb">
    <div class="container-custom">
        <ul class="breadcrumb-list">
            <li class="breadcrumb-item">
                <a href="{{ route('events.index') }}">Events</a>
            </li>
            <li class="breadcrumb-separator">
                <i class="bi bi-chevron-right"></i>
            </li>
            <li class="breadcrumb-item active">
                {{ Str::limit($event->name, 40) }}
            </li>
        </ul>
    </div>
</div>

{{-- Event Hero --}}
<div class="event-hero">
    <div class="container-custom">
        <div class="event-hero-grid">
            {{-- Left Column --}}
            <div class="event-hero-content">
                <div class="event-badges animate">
                    @if($event->category)
                        <span class="event-category">
                            <i class="{{ $event->category_icon }}"></i>
                            {{ $event->category }}
                        </span>
                    @endif
                    
                    <span class="event-status {{ $event->status }}">
                        <i class="bi bi-circle-fill"></i>
                        {{ ucfirst($event->status) }}
                    </span>
                </div>

                <h1 class="event-title animate" style="animation-delay: 0.1s">
                    {{ $event->name }}
                </h1>

                <div class="event-meta-grid animate" style="animation-delay: 0.2s">
                    <div class="event-meta-item">
                        <div class="event-meta-icon">
                            <i class="bi bi-calendar3"></i>
                        </div>
                        <div class="event-meta-content">
                            <div class="event-meta-label">Date</div>
                            <div class="event-meta-value">
                                {{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="event-meta-item">
                        <div class="event-meta-icon">
                            <i class="bi bi-clock"></i>
                        </div>
                        <div class="event-meta-content">
                            <div class="event-meta-label">Time</div>
                            <div class="event-meta-value">
                                {{ \Carbon\Carbon::parse($event->time)->format('g:i A') }}
                            </div>
                        </div>
                    </div>

                    <div class="event-meta-item">
                        <div class="event-meta-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="event-meta-content">
                            <div class="event-meta-label">Location</div>
                            <div class="event-meta-value">
                                {{ $event->location }}
                            </div>
                        </div>
                    </div>

                    @if($event->tickets->isNotEmpty())
                        <div class="event-meta-item">
                            <div class="event-meta-icon">
                                <i class="bi bi-ticket-perforated"></i>
                            </div>
                            <div class="event-meta-content">
                                <div class="event-meta-label">Starting from</div>
                                <div class="event-meta-value">
                                    ${{ number_format($event->tickets->min('price'), 2) }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right Column - Ticket Sidebar --}}
            <div class="ticket-sidebar animate" style="animation-delay: 0.3s">
                <div class="ticket-header">
                    <span class="ticket-header-title">Available Tickets</span>
                    <span class="ticket-header-count">{{ $event->tickets->count() }}</span>
                </div>

                @if($event->tickets->isNotEmpty())
                    <div class="ticket-list">
                        @foreach($event->tickets as $ticket)
                            <div class="ticket-item">
                                <div class="ticket-item-header">
                                    <span class="ticket-type">
                                        {{ $ticket->ticket_type ?? 'General Admission' }}
                                    </span>
                                    <span class="ticket-price">
                                        <small>$</small>{{ number_format($ticket->price, 2) }}
                                    </span>
                                </div>

                                @if($ticket->quantity_available)
                                    <div class="ticket-availability {{ $ticket->quantity_available < 20 ? 'low' : '' }}">
                                        <i class="bi bi-info-circle"></i>
                                        {{ $ticket->quantity_available < 20 
                                            ? 'Only ' . $ticket->quantity_available . ' tickets left!'
                                            : $ticket->quantity_available . ' available' }}
                                    </div>
                                @endif

                                @auth
                                    <form action="{{ route('cart.add', $ticket) }}" method="POST">
                                        @csrf
                                        <div class="quantity-selector">
                                            <span class="quantity-label">Quantity</span>
                                            <div class="quantity-controls">
                                                <button type="button" class="quantity-btn" onclick="decrementQty(this)" {{ $ticket->quantity_available < 1 ? 'disabled' : '' }}>
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                                <input type="number" name="quantity" class="quantity-input" value="1" min="1" max="{{ $ticket->quantity_available ?? 99 }}" readonly>
                                                <button type="button" class="quantity-btn" onclick="incrementQty(this)" {{ $ticket->quantity_available < 1 ? 'disabled' : '' }}>
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="ticket-actions">
                                            <button type="submit" name="action" value="cart" class="btn-outline">
                                                <i class="bi bi-cart"></i>
                                                Add to Cart
                                            </button>
                                            <button type="submit" name="action" value="checkout" class="btn-primary">
                                                <i class="bi bi-lightning-charge"></i>
                                                Buy Now
                                            </button>
                                        </div>
                                    </form>
                                @endauth
                            </div>
                        @endforeach
                    </div>

                    @guest
                        <div style="padding: 20px 24px; border-top: 1px solid var(--border);">
                            <a href="{{ route('login') }}" class="btn-block">
                                <i class="bi bi-box-arrow-in-right"></i>
                                Log in to purchase tickets
                            </a>
                        </div>
                    @endguest

                @else
                    <div class="ticket-empty">
                        <i class="bi bi-ticket"></i>
                        <p>No tickets available at this time.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Main Content --}}
<div class="content-section">
    <div class="container-custom">
        <div class="content-grid">
            {{-- Description --}}
            <div class="description animate">
                <h2>About this event</h2>
                <div class="description-text">
                    {!! nl2br(e($event->description ?? 'No description provided for this event.')) !!}
                </div>
            </div>

            {{-- Info Panel --}}
            <div class="animate" style="animation-delay: 0.1s">
                <div class="info-panel">
                    <div class="info-panel-header">Event Details</div>
                    <div class="info-panel-body">
                        <div class="info-row">
                            <div class="info-icon">
                                <i class="bi bi-calendar3"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Date</div>
                                <div class="info-value">
                                    {{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y') }}
                                </div>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-icon">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Time</div>
                                <div class="info-value">
                                    {{ \Carbon\Carbon::parse($event->time)->format('g:i A') }}
                                </div>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Location</div>
                                <div class="info-value">{{ $event->location }}</div>
                            </div>
                        </div>

                        @if($event->category)
                            <div class="info-row">
                                <div class="info-icon">
                                    <i class="{{ $event->category_icon }}"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Category</div>
                                    <div class="info-value">{{ $event->category }}</div>
                                </div>
                            </div>
                        @endif

                        <div class="info-row">
                            <div class="info-icon">
                                <i class="bi bi-tag"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Status</div>
                                <div class="info-value" style="text-transform: capitalize;">{{ $event->status }}</div>
                            </div>
                        </div>

                        @if($event->creator)
                            <div class="info-row">
                                <div class="info-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Organized by</div>
                                    <div class="info-value">{{ $event->creator->name }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <a href="{{ route('events.index') }}" class="back-link">
                    <i class="bi bi-arrow-left"></i>
                    Back to all events
                </a>
            </div>
        </div>
    </div>
</div>
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

    document.querySelectorAll('.animate').forEach(el => observer.observe(el));

    // Quantity controls
    function incrementQty(btn) {
        const container = btn.closest('.quantity-controls');
        const input = container.querySelector('.quantity-input');
        const max = parseInt(input.max);
        let value = parseInt(input.value);
        if (value < max) {
            input.value = value + 1;
        }
    }

    function decrementQty(btn) {
        const container = btn.closest('.quantity-controls');
        const input = container.querySelector('.quantity-input');
        const min = parseInt(input.min);
        let value = parseInt(input.value);
        if (value > min) {
            input.value = value - 1;
        }
    }

    // Sticky sidebar adjustment
    const ticketSidebar = document.querySelector('.ticket-sidebar');
    if (ticketSidebar) {
        const updateSticky = () => {
            const heroBottom = document.querySelector('.event-hero').offsetHeight;
            if (window.scrollY > heroBottom) {
                ticketSidebar.style.top = '24px';
            }
        };
        window.addEventListener('scroll', updateSticky);
    }
</script>
@endpush