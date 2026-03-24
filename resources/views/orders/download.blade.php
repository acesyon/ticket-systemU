@extends('layouts.app')

@section('title', 'Download Ticket #' . $order->id)

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
.ticket-header {
    background: var(--ink);
    padding: 48px 0 40px;
    position: relative;
    overflow: hidden;
}

.ticket-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
    background-size: 32px 32px;
    pointer-events: none;
}

.ticket-header::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--gold), transparent);
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
    margin-bottom: 16px;
}

.header-eyebrow::before {
    content: '';
    display: block;
    width: 24px;
    height: 1px;
    background: var(--gold);
}

.ticket-header h1 {
    font-family: var(--f-display);
    font-size: clamp(40px, 5vw, 56px);
    font-weight: 600;
    line-height: 1.0;
    letter-spacing: -0.03em;
    color: var(--white);
}

.ticket-header h1 em {
    font-style: italic;
    font-weight: 300;
    color: var(--gold);
}

/* Action Buttons */
.action-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-top: 28px;
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

.btn-print {
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
    border: none;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-print:hover {
    background: var(--gold-light);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(201,168,76,0.25);
}

/* ═══════════════════════════════════════════════════════════════════════════
   TICKET CONTAINER
═══════════════════════════════════════════════════════════════════════════ */
.ticket-container {
    margin: 48px auto 80px;
    max-width: 880px;
}

.ticket {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    box-shadow: var(--shadow-lift);
    position: relative;
}

/* Ticket Header */
.ticket-header-gradient {
    background: linear-gradient(135deg, var(--ink) 0%, var(--ink-2) 100%);
    padding: 40px 40px 32px;
    position: relative;
    border-bottom: 1px solid var(--border);
}

.ticket-header-gradient::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--gold), transparent);
}

.ticket-type-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(201,168,76,0.15);
    backdrop-filter: blur(10px);
    padding: 6px 14px;
    border-radius: 100px;
    color: var(--gold);
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 24px;
    width: fit-content;
    border: 1px solid rgba(201,168,76,0.3);
}

.ticket-title {
    font-family: var(--f-display);
    font-size: 32px;
    font-weight: 600;
    color: var(--white);
    margin-bottom: 12px;
    line-height: 1.2;
    letter-spacing: -0.02em;
}

.ticket-subtitle {
    font-size: 14px;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 8px;
}

.ticket-subtitle i {
    color: var(--gold);
}

/* Ticket Body */
.ticket-body {
    padding: 40px;
}

/* Event Details Grid */
.event-details-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 28px;
    margin-bottom: 36px;
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

/* Perforated Divider */
.ticket-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 32px 0;
    position: relative;
}

.ticket-divider::before,
.ticket-divider::after {
    content: '';
    flex: 1;
    height: 2px;
    background: repeating-linear-gradient(
        90deg,
        var(--border) 0px,
        var(--border) 6px,
        transparent 6px,
        transparent 12px
    );
}

.ticket-divider-icon {
    width: 44px;
    height: 44px;
    background: var(--mist);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    font-size: 18px;
    border: 1px solid var(--border);
    margin: 0 16px;
}

/* Attendee Section */
.attendee-section {
    background: var(--mist);
    border-radius: var(--r-lg);
    padding: 28px;
    margin-bottom: 32px;
    border: 1px solid var(--border);
}

.attendee-title {
    font-family: var(--f-display);
    font-size: 16px;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.attendee-title i {
    color: var(--gold);
}

.attendee-details {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.attendee-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.attendee-item-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
}

.attendee-item-value {
    font-weight: 500;
    color: var(--ink);
    font-size: 14px;
}

/* Order Summary Box */
.order-summary-box {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    padding: 24px;
    margin-bottom: 32px;
}

.order-summary-item {
    text-align: center;
}

.order-summary-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 8px;
    display: block;
}

.order-summary-value {
    font-family: var(--f-display);
    font-weight: 600;
    color: var(--ink);
    font-size: 20px;
}

.order-summary-value.highlight {
    color: var(--gold);
}

/* QR Code Section */
.qr-section {
    display: flex;
    align-items: center;
    gap: 28px;
    padding: 28px;
    background: var(--mist);
    border-radius: var(--r-lg);
    border: 1px solid var(--border);
}

.qr-code {
    width: 120px;
    height: 120px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold);
    font-size: 64px;
    flex-shrink: 0;
}

.qr-info {
    flex: 1;
}

.qr-info-title {
    font-family: var(--f-display);
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 6px;
    font-size: 16px;
}

.qr-info-text {
    color: var(--text-muted);
    font-size: 13px;
    margin-bottom: 10px;
    line-height: 1.5;
}

.qr-info-note {
    font-size: 12px;
    color: var(--success);
    display: flex;
    align-items: center;
    gap: 6px;
}

/* Ticket Footer */
.ticket-footer {
    background: var(--mist-2);
    padding: 24px 40px;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.ticket-footer-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.ticket-footer-icon {
    width: 44px;
    height: 44px;
    background: var(--success-soft);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--success);
    font-size: 20px;
}

.ticket-footer-text strong {
    font-size: 14px;
    color: var(--ink);
    display: block;
}

.ticket-footer-text span {
    font-size: 12px;
    color: var(--text-muted);
}

.ticket-footer-right {
    font-size: 12px;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 6px;
}

.ticket-footer-right i {
    color: var(--gold);
}

/* Terms */
.ticket-terms {
    padding: 20px 40px;
    background: var(--white);
    border-top: 1px solid var(--border);
    font-size: 12px;
    color: var(--text-muted);
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.ticket-terms i {
    color: var(--gold);
}

/* Animations */
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

/* Print Styles */
@media print {
    .d-print-none {
        display: none !important;
    }

    body {
        background: white;
        padding: 0;
        margin: 0;
    }

    .ticket-header {
        display: none;
    }

    .ticket-container {
        margin: 0;
        max-width: 100%;
    }

    .ticket {
        box-shadow: none;
        border: 1px solid #ddd;
        border-radius: 0;
    }

    .ticket-header-gradient {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        background: var(--ink);
    }

    .qr-section {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    .btn-back,
    .btn-print {
        display: none;
    }
}

/* Responsive */
@media (max-width: 768px) {
    .wrap {
        padding: 0 20px;
    }
    
    .ticket-header {
        padding: 40px 0 32px;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: stretch;
    }
    
    .btn-back,
    .btn-print {
        justify-content: center;
    }
    
    .ticket-header-gradient {
        padding: 28px 24px;
    }
    
    .ticket-title {
        font-size: 26px;
    }
    
    .ticket-body {
        padding: 28px 24px;
    }
    
    .event-details-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .attendee-details {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .order-summary-box {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    
    .qr-section {
        flex-direction: column;
        text-align: center;
        gap: 20px;
    }
    
    .ticket-footer {
        flex-direction: column;
        text-align: center;
        padding: 20px 24px;
    }
    
    .ticket-footer-left {
        flex-direction: column;
        text-align: center;
    }
    
    .ticket-terms {
        padding: 16px 24px;
    }
}
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════════════════════════════════════
     HEADER SECTION
═══════════════════════════════════════════════════════════════════════════ --}}
<div class="ticket-header">
    <div class="wrap">
        <div class="header-eyebrow">Digital Ticket</div>
        <h1>Your <em>E-Ticket</em></h1>
        
        <div class="action-buttons d-print-none">
            <a href="{{ route('orders.show', $order) }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                Back to Order
            </a>
            <button onclick="window.print()" class="btn-print">
                <i class="bi bi-printer"></i>
                Print Ticket
            </button>
        </div>
    </div>
</div>

<div class="wrap">
    <div class="ticket-container anim-fade">
        <div class="ticket" id="ticket">
            
            {{-- Ticket Header with Gradient --}}
            <div class="ticket-header-gradient">
                <div class="ticket-type-badge">
                    <i class="bi bi-ticket-perforated"></i>
                    {{ $order->ticket->ticket_type ?? 'Standard' }}
                </div>
                <h1 class="ticket-title">{{ $order->ticket->event->name ?? 'Event Name' }}</h1>
                <div class="ticket-subtitle">
                    <i class="bi bi-building"></i>
                    {{ config('app.name', 'Ticketing System') }} · Digital Ticket
                </div>
            </div>

            {{-- Ticket Body --}}
            <div class="ticket-body">
                
                {{-- Event Details Grid --}}
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
                            <i class="bi bi-hash"></i>
                        </div>
                        <div class="event-detail-content">
                            <span class="event-detail-label">Order ID</span>
                            <span class="event-detail-value">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                </div>

                {{-- Perforated Divider --}}
                <div class="ticket-divider">
                    <span class="ticket-divider-icon">
                        <i class="bi bi-scissors"></i>
                    </span>
                </div>

                {{-- Attendee Section --}}
                <div class="attendee-section">
                    <div class="attendee-title">
                        <i class="bi bi-person-circle"></i>
                        Attendee Information
                    </div>
                    <div class="attendee-details">
                        <div class="attendee-item">
                            <span class="attendee-item-label">Full Name</span>
                            <span class="attendee-item-value">
                                {{ $order->user->first_name ?? '' }} 
                                {{ $order->user->middle_name ? $order->user->middle_name . ' ' : '' }}
                                {{ $order->user->last_name ?? '' }}
                            </span>
                        </div>
                        <div class="attendee-item">
                            <span class="attendee-item-label">Email Address</span>
                            <span class="attendee-item-value">{{ $order->user->email ?? 'N/A' }}</span>
                        </div>
                        @if($order->user->contact_no ?? false)
                            <div class="attendee-item">
                                <span class="attendee-item-label">Contact Number</span>
                                <span class="attendee-item-value">{{ $order->user->contact_no }}</span>
                            </div>
                        @endif
                        <div class="attendee-item">
                            <span class="attendee-item-label">Ticket Type</span>
                            <span class="attendee-item-value">{{ $order->ticket->ticket_type ?? 'Standard' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Order Summary Box --}}
                <div class="order-summary-box">
                    <div class="order-summary-item">
                        <span class="order-summary-label">Quantity</span>
                        <span class="order-summary-value">{{ $order->quantity }}</span>
                    </div>
                    <div class="order-summary-item">
                        <span class="order-summary-label">Price</span>
                        <span class="order-summary-value">${{ number_format($order->ticket->price ?? 0, 2) }}</span>
                    </div>
                    <div class="order-summary-item">
                        <span class="order-summary-label">Payment</span>
                        <span class="order-summary-value">{{ ucfirst(str_replace('_', ' ', $order->payment->payment_method ?? 'Cash')) }}</span>
                    </div>
                    <div class="order-summary-item">
                        <span class="order-summary-label">Total</span>
                        <span class="order-summary-value highlight">${{ number_format($order->payment->amount ?? $order->total_price ?? 0, 2) }}</span>
                    </div>
                </div>

                {{-- QR Code Section --}}
                <div class="qr-section">
                    <div class="qr-code">
                        <i class="bi bi-qr-code-scan"></i>
                    </div>
                    <div class="qr-info">
                        <div class="qr-info-title">Digital Ticket</div>
                        <p class="qr-info-text">Scan this QR code at the venue entrance for quick and secure verification.</p>
                        <div class="qr-info-note">
                            <i class="bi bi-shield-check"></i>
                            Secure & Verifiable
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ticket Footer --}}
            <div class="ticket-footer">
                <div class="ticket-footer-left">
                    <div class="ticket-footer-icon">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <div class="ticket-footer-text">
                        <strong>CONFIRMED</strong>
                        <span>Valid for entry</span>
                    </div>
                </div>
                <div class="ticket-footer-right">
                    <i class="bi bi-clock-history"></i>
                    Purchased: {{ \Carbon\Carbon::parse($order->created_at ?? now())->format('M d, Y') }}
                </div>
            </div>

            {{-- Terms --}}
            <div class="ticket-terms">
                <i class="bi bi-info-circle"></i>
                This ticket is non-refundable and non-transferable. Please present this ticket (digital or printed) at the venue entrance for verification.
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
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
    
    // Print optimization
    window.onbeforeprint = function() {
        const ticket = document.querySelector('.ticket');
        if (ticket) {
            ticket.style.boxShadow = 'none';
        }
    };
    
    window.onafterprint = function() {
        const ticket = document.querySelector('.ticket');
        if (ticket) {
            ticket.style.boxShadow = '';
        }
    };
});
</script>
@endpush