@extends('layouts.app')

@section('title', 'Order Details')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,600;0,9..144,700;1,9..144,300&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* ═══════════════════════════════════════════════════════════════════════════
   TOKENS — consistent with all pages
═══════════════════════════════════════════════════════════════════════════ */
:root {
    --ink:        #0d0d0d;
    --ink-2:      #1c1c1c;
    --ink-3:      #2e2e2e;
    --mist:       #f7f6f3;
    --mist-2:     #efede8;
    --border:     #e3e0d8;
    --border-dk:  #2e2e2e;
    --gold:       #c9a84c;
    --gold-light: #e8c96a;
    --gold-soft:  #f5edd8;
    --white:      #ffffff;
    --text-body:  #4a4742;
    --text-muted: #8c8882;
    --success:    #2d7a5f;
    --success-soft: #e2f0ea;
    --warning:    #d97706;
    --warning-soft: #fef3c7;
    --error:      #c0392b;
    --error-soft: #fbe9e7;

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

/* ═══════════════════════════════════════════════════════════════════════════
   PAGE HEADER
═══════════════════════════════════════════════════════════════════════════ */
.order-header {
    background: var(--ink);
    padding: 64px 0 56px;
    position: relative;
    overflow: hidden;
}

.order-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
    background-size: 32px 32px;
    pointer-events: none;
}

.order-header::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--gold), transparent);
}

.header-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    flex-wrap: wrap;
    position: relative;
    z-index: 1;
}

.header-left {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.header-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gold);
}

.header-eyebrow::before {
    content: '';
    display: block;
    width: 24px;
    height: 1px;
    background: var(--gold);
}

.order-header h1 {
    font-family: var(--f-display);
    font-size: clamp(36px, 5vw, 48px);
    font-weight: 600;
    line-height: 1.0;
    letter-spacing: -0.03em;
    color: var(--white);
}

.order-header h1 em {
    font-style: italic;
    font-weight: 300;
    color: var(--gold);
}

.order-header h1 span {
    font-family: var(--f-body);
    font-size: 20px;
    font-weight: 500;
    color: var(--text-muted);
    margin-left: 12px;
}

/* Action Buttons */
.header-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: transparent;
    color: var(--text-muted);
    font-weight: 500;
    font-size: 14px;
    padding: 12px 24px;
    border-radius: var(--r-md);
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.15);
    transition: all 0.2s;
}

.btn-back:hover {
    border-color: var(--gold);
    color: var(--gold);
    background: rgba(201,168,76,0.1);
}

.btn-download {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--gold);
    color: var(--ink);
    font-weight: 600;
    font-size: 14px;
    padding: 12px 28px;
    border-radius: var(--r-md);
    text-decoration: none;
    transition: all 0.2s;
}

.btn-download:hover {
    background: var(--gold-light);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(201,168,76,0.25);
}

/* ═══════════════════════════════════════════════════════════════════════════
   ORDER LAYOUT
═══════════════════════════════════════════════════════════════════════════ */
.order-layout {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 40px;
    margin: 48px 0 80px;
    align-items: start;
}

/* ═══════════════════════════════════════════════════════════════════════════
   CARDS — consistent with other pages
═══════════════════════════════════════════════════════════════════════════ */
.order-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    margin-bottom: 28px;
}

.order-card:last-child {
    margin-bottom: 0;
}

.card-header {
    padding: 20px 28px;
    background: var(--mist-2);
    border-bottom: 1px solid var(--border);
}

.card-header h2 {
    font-family: var(--f-display);
    font-size: 18px;
    font-weight: 600;
    color: var(--ink);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
    letter-spacing: -0.02em;
}

.card-header h2 i {
    color: var(--gold);
    font-size: 20px;
}

.card-body {
    padding: 28px;
}

/* Event Title */
.event-title {
    font-family: var(--f-display);
    font-size: 28px;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 24px;
    line-height: 1.2;
    letter-spacing: -0.02em;
}

/* Event Details Grid */
.event-details-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
    margin-bottom: 28px;
}

.event-detail-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.event-detail-icon {
    width: 48px;
    height: 48px;
    background: var(--gold-soft);
    border-radius: var(--r-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold);
    font-size: 20px;
    flex-shrink: 0;
}

.event-detail-content {
    flex: 1;
}

.event-detail-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 6px;
    display: block;
}

.event-detail-value {
    font-family: var(--f-display);
    font-weight: 600;
    color: var(--ink);
    font-size: 16px;
    letter-spacing: -0.01em;
}

/* Description Section */
.event-description {
    margin-top: 24px;
    padding-top: 24px;
    border-top: 1px solid var(--border);
}

.event-description-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.event-description-label i {
    color: var(--gold);
}

.event-description-text {
    color: var(--text-body);
    font-size: 14px;
    line-height: 1.65;
}

/* Additional Info Card */
.additional-info {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.additional-info i {
    color: var(--gold);
    font-size: 22px;
    flex-shrink: 0;
}

.additional-info p {
    color: var(--text-muted);
    font-size: 14px;
    margin-bottom: 8px;
}

.additional-info p strong {
    color: var(--ink);
}

.additional-info p:last-child {
    margin-bottom: 0;
}

/* ═══════════════════════════════════════════════════════════════════════════
   ORDER SUMMARY SIDEBAR
═══════════════════════════════════════════════════════════════════════════ */
.order-summary-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    position: sticky;
    top: 100px;
}

.summary-header {
    padding: 20px 28px;
    background: var(--mist-2);
    border-bottom: 1px solid var(--border);
}

.summary-header h3 {
    font-family: var(--f-display);
    font-size: 18px;
    font-weight: 600;
    color: var(--ink);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.summary-header h3 i {
    color: var(--gold);
}

.summary-body {
    padding: 28px;
}

/* Summary Table */
.summary-table {
    width: 100%;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 0;
    border-bottom: 1px dashed var(--border);
}

.summary-row:last-child {
    border-bottom: none;
}

.summary-label {
    color: var(--text-muted);
    font-size: 13px;
}

.summary-value {
    font-weight: 500;
    color: var(--ink);
    font-size: 14px;
}

.summary-value.id {
    font-family: var(--f-body);
    letter-spacing: 0.02em;
}

.summary-row.highlight {
    background: var(--gold-soft);
    margin-top: 12px;
    padding: 16px;
    border-radius: var(--r-lg);
    border-bottom: none;
}

.summary-row.highlight .summary-label {
    font-weight: 600;
    color: var(--ink);
    font-size: 14px;
}

.summary-row.highlight .summary-value {
    font-family: var(--f-display);
    font-weight: 700;
    color: var(--gold);
    font-size: 22px;
}

/* Status Badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 14px;
    border-radius: 100px;
    font-size: 12px;
    font-weight: 600;
}

.status-badge.completed {
    background: var(--success-soft);
    color: var(--success);
}

.status-badge.pending {
    background: var(--warning-soft);
    color: var(--warning);
}

.status-badge.cancelled,
.status-badge.failed {
    background: var(--error-soft);
    color: var(--error);
}

/* QR Code Section */
.qr-section {
    margin-top: 28px;
    padding-top: 24px;
    border-top: 1px solid var(--border);
    text-align: center;
}

.qr-placeholder {
    width: 120px;
    height: 120px;
    background: var(--mist);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    margin: 0 auto 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold);
    font-size: 48px;
}

.qr-label {
    font-size: 11px;
    color: var(--text-muted);
    letter-spacing: 0.05em;
}

/* Venue Info Card */
.venue-card {
    margin-top: 20px;
    background: var(--mist);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    padding: 20px;
}

.venue-card-content {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.venue-card-content i {
    color: var(--gold);
    font-size: 20px;
    flex-shrink: 0;
}

.venue-card-content p {
    margin: 0;
}

.venue-title {
    font-weight: 600;
    color: var(--ink);
    font-size: 13px;
    margin-bottom: 4px;
}

.venue-address {
    color: var(--text-muted);
    font-size: 12px;
    line-height: 1.5;
}

/* ═══════════════════════════════════════════════════════════════════════════
   ANIMATIONS
═══════════════════════════════════════════════════════════════════════════ */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(24px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.anim-fade {
    opacity: 0;
    animation: fadeUp 0.6s cubic-bezier(0.22, 1, 0.36, 1) forwards;
}

/* ═══════════════════════════════════════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════════════════════════════════════ */
@media (max-width: 1024px) {
    .order-layout {
        grid-template-columns: 1fr;
        gap: 32px;
    }
    
    .order-summary-card {
        position: static;
    }
}

@media (max-width: 768px) {
    .wrap {
        padding: 0 20px;
    }
    
    .order-header {
        padding: 48px 0 40px;
    }
    
    .header-inner {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .header-actions {
        width: 100%;
        flex-direction: column;
    }
    
    .btn-back,
    .btn-download {
        justify-content: center;
    }
    
    .event-details-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .card-header {
        padding: 16px 20px;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .event-title {
        font-size: 24px;
    }
    
    .summary-header {
        padding: 16px 20px;
    }
    
    .summary-body {
        padding: 20px;
    }
    
    .summary-row.highlight .summary-value {
        font-size: 20px;
    }
}
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════════════════════════════════════
     HEADER SECTION
═══════════════════════════════════════════════════════════════════════════ --}}
<div class="order-header">
    <div class="wrap">
        <div class="header-inner">
            <div class="header-left">
                <div class="header-eyebrow">Order Information</div>
                <h1>
                    Order <em>Details</em>
                    <span>#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                </h1>
            </div>
            
            <div class="header-actions">
                <a href="{{ route('orders.index') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Back to Orders
                </a>
                @if($order->status === 'completed')
                    <a href="{{ route('orders.download', $order) }}" class="btn-download">
                        <i class="bi bi-download"></i>
                        Download Ticket
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="wrap">
    <div class="order-layout">
        
        {{-- LEFT COLUMN: Event Information --}}
        <div class="order-main">
            
            {{-- Event Info Card --}}
            <div class="order-card anim-fade">
                <div class="card-header">
                    <h2>
                        <i class="bi bi-calendar-event"></i>
                        Event Information
                    </h2>
                </div>
                <div class="card-body">
                    <h3 class="event-title">{{ $order->ticket->event->name ?? 'Event' }}</h3>
                    
                    <div class="event-details-grid">
                        <div class="event-detail-item">
                            <div class="event-detail-icon">
                                <i class="bi bi-calendar3"></i>
                            </div>
                            <div class="event-detail-content">
                                <span class="event-detail-label">Date</span>
                                <span class="event-detail-value">
                                    {{ \Carbon\Carbon::parse($order->ticket->event->date ?? now())->format('l, F d, Y') }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="event-detail-item">
                            <div class="event-detail-icon">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="event-detail-content">
                                <span class="event-detail-label">Time</span>
                                <span class="event-detail-value">
                                    {{ \Carbon\Carbon::parse($order->ticket->event->time ?? now())->format('h:i A') }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="event-detail-item">
                            <div class="event-detail-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div class="event-detail-content">
                                <span class="event-detail-label">Location</span>
                                <span class="event-detail-value">{{ $order->ticket->event->location ?? 'To be announced' }}</span>
                            </div>
                        </div>
                        
                        <div class="event-detail-item">
                            <div class="event-detail-icon">
                                <i class="bi bi-ticket-perforated"></i>
                            </div>
                            <div class="event-detail-content">
                                <span class="event-detail-label">Ticket Type</span>
                                <span class="event-detail-value">{{ $order->ticket->ticket_type ?? 'Standard' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    @if(!empty($order->ticket->event->description))
                        <div class="event-description">
                            <span class="event-description-label">
                                <i class="bi bi-info-circle"></i>
                                About the Event
                            </span>
                            <p class="event-description-text">{{ $order->ticket->event->description }}</p>
                        </div>
                    @endif
                </div>
            </div>
            
            {{-- Additional Information Card --}}
            <div class="order-card anim-fade" style="animation-delay: 0.08s">
                <div class="card-header">
                    <h2>
                        <i class="bi bi-info-circle"></i>
                        Additional Information
                    </h2>
                </div>
                <div class="card-body">
                    <div class="additional-info">
                        <i class="bi bi-shield-check"></i>
                        <div>
                            <p><strong>Ticket Policy:</strong> This ticket is non-refundable and non-transferable.</p>
                            <p><strong>Entry:</strong> Please present this ticket (digital or printed) at the venue entrance for verification.</p>
                            <p><strong>Doors Open:</strong> 1 hour before the event starts.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- RIGHT COLUMN: Order Summary --}}
        <div class="order-sidebar">
            <div class="order-summary-card anim-fade" style="animation-delay: 0.15s">
                <div class="summary-header">
                    <h3>
                        <i class="bi bi-receipt"></i>
                        Order Summary
                    </h3>
                </div>
                <div class="summary-body">
                    <div class="summary-table">
                        <div class="summary-row">
                            <span class="summary-label">Order ID</span>
                            <span class="summary-value id">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        
                        <div class="summary-row">
                            <span class="summary-label">Status</span>
                            <span class="summary-value">
                                <span class="status-badge {{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </span>
                        </div>
                        
                        <div class="summary-row">
                            <span class="summary-label">Quantity</span>
                            <span class="summary-value">{{ $order->quantity }} ticket(s)</span>
                        </div>
                        
                        <div class="summary-row">
                            <span class="summary-label">Price per ticket</span>
                            <span class="summary-value">${{ number_format($order->ticket->price ?? 0, 2) }}</span>
                        </div>
                        
                        <div class="summary-row">
                            <span class="summary-label">Subtotal</span>
                            <span class="summary-value">
                                ${{ number_format(($order->ticket->price ?? 0) * $order->quantity, 2) }}
                            </span>
                        </div>
                        
                        <div class="summary-row">
                            <span class="summary-label">Payment Method</span>
                            <span class="summary-value">
                                {{ ucfirst(str_replace('_', ' ', $order->payment->payment_method ?? 'Cash')) }}
                            </span>
                        </div>
                        
                        <div class="summary-row">
                            <span class="summary-label">Date Paid</span>
                            <span class="summary-value">
                                {{ isset($order->payment->date_paid) 
                                    ? \Carbon\Carbon::parse($order->payment->date_paid)->format('M d, Y h:i A') 
                                    : ($order->date_purchased ? \Carbon\Carbon::parse($order->date_purchased)->format('M d, Y h:i A') : 'N/A') }}
                            </span>
                        </div>
                        
                        <div class="summary-row highlight">
                            <span class="summary-label">Total Amount</span>
                            <span class="summary-value">
                                ${{ number_format($order->payment->amount ?? $order->total_price ?? 0, 2) }}
                            </span>
                        </div>
                    </div>
                    
                    {{-- QR Code Section --}}
                    <div class="qr-section">
                        <div class="qr-placeholder">
                            <i class="bi bi-qr-code-scan"></i>
                        </div>
                        <p class="qr-label">Scan for entry verification</p>
                    </div>
                </div>
            </div>
            
            {{-- Venue Information Card --}}
            <div class="venue-card">
                <div class="venue-card-content">
                    <i class="bi bi-building"></i>
                    <div>
                        <p class="venue-title">Venue Information</p>
                        <p class="venue-address">
                            {{ $order->ticket->event->venue ?? $order->ticket->event->location ?? 'TBA' }}
                        </p>
                        <p class="venue-address" style="margin-top: 6px;">
                            <i class="bi bi-clock-history me-1"></i>
                            Doors open 1 hour before event
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection

@push('scripts')
<script>
(function() {
    // Intersection Observer for animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.05, rootMargin: '0px 0px -30px 0px' });

    document.querySelectorAll('.anim-fade').forEach(el => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });
})();
</script>
@endpush