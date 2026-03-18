@extends('layouts.app')

@section('title', 'Download Ticket #' . $order->id)

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
        --success-soft: #e6f7e6;
        --warning: #f59e0b;
        --error: #ef4444;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.02), 0 1px 2px rgba(0,0,0,0.02);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.01);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.02), 0 4px 6px -2px rgba(0,0,0,0.01);
        --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.02), 0 10px 10px -5px rgba(0,0,0,0.01);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 24px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: var(--off-white);
        color: var(--text-primary);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        line-height: 1.5;
        -webkit-font-smoothing: antialiased;
    }

    .container-custom {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Page Header */
    .ticket-header {
        padding: 40px 0 24px;
    }

    .ticket-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text-secondary);
        font-weight: 500;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-back:hover {
        border-color: var(--accent);
        color: var(--accent);
        background: var(--off-white);
    }

    .btn-back i {
        transition: transform 0.2s;
    }

    .btn-back:hover i {
        transform: translateX(-4px);
    }

    .btn-print {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 28px;
        background: var(--accent);
        border: none;
        border-radius: var(--radius-sm);
        color: white;
        font-weight: 500;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
    }

    .btn-print:hover {
        background: var(--accent-light);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-print i {
        transition: transform 0.2s;
    }

    .btn-print:hover i {
        transform: translateY(-2px);
    }

    /* Ticket Container */
    .ticket-container {
        margin: 24px 0 60px;
        position: relative;
    }

    /* Main Ticket Card */
    .ticket {
        background: var(--white);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-xl);
        overflow: hidden;
        position: relative;
        border: 1px solid var(--border);
    }

    /* Ticket Header with Diagonal Cut */
    .ticket-header-gradient {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
        padding: 40px 40px 32px;
        position: relative;
    }

    .ticket-header-gradient::after {
        content: '';
        position: absolute;
        bottom: -20px;
        left: 0;
        right: 0;
        height: 40px;
        background: linear-gradient(135deg, transparent 50%, var(--white) 50%);
    }

    .ticket-type-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 8px 16px;
        border-radius: 100px;
        color: white;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 20px;
        width: fit-content;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .ticket-title {
        font-size: 36px;
        font-weight: 700;
        color: white;
        margin-bottom: 8px;
        line-height: 1.2;
    }

    .ticket-subtitle {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .ticket-subtitle i {
        font-size: 18px;
    }

    /* Ticket Body */
    .ticket-body {
        padding: 40px;
        background: var(--white);
    }

    /* Event Details Grid */
    .event-details-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }

    .event-detail-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .event-detail-icon {
        width: 44px;
        height: 44px;
        background: var(--accent-soft);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        font-size: 20px;
        flex-shrink: 0;
    }

    .event-detail-content {
        flex: 1;
    }

    .event-detail-label {
        font-size: 12px;
        color: var(--text-tertiary);
        text-transform: uppercase;
        letter-spacing: 0.03em;
        margin-bottom: 4px;
        display: block;
    }

    .event-detail-value {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 16px;
    }

    /* Divider with Perforation Effect */
    .ticket-divider {
        display: flex;
        align-items: center;
        gap: 16px;
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
            var(--border) 8px,
            transparent 8px,
            transparent 16px
        );
    }

    .ticket-divider-icon {
        width: 40px;
        height: 40px;
        background: var(--off-white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-tertiary);
        font-size: 18px;
        border: 1px solid var(--border);
    }

    /* Attendee Section */
    .attendee-section {
        background: var(--off-white);
        border-radius: var(--radius-lg);
        padding: 28px;
        margin-bottom: 32px;
        border: 1px solid var(--border);
    }

    .attendee-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .attendee-title i {
        color: var(--accent);
    }

    .attendee-details {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .attendee-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .attendee-item-label {
        font-size: 12px;
        color: var(--text-tertiary);
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .attendee-item-value {
        font-weight: 500;
        color: var(--text-primary);
        font-size: 15px;
    }

    /* Order Summary Box */
    .order-summary-box {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 24px;
        margin-bottom: 24px;
    }

    .order-summary-item {
        text-align: center;
    }

    .order-summary-label {
        font-size: 11px;
        color: var(--text-tertiary);
        text-transform: uppercase;
        letter-spacing: 0.03em;
        margin-bottom: 4px;
        display: block;
    }

    .order-summary-value {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 16px;
    }

    .order-summary-value.highlight {
        color: var(--success);
    }

    /* QR Code Section */
    .qr-section {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 32px;
        padding: 24px;
        background: var(--off-white);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
    }

    .qr-code {
        width: 120px;
        height: 120px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-tertiary);
        font-size: 64px;
    }

    .qr-info {
        flex: 1;
    }

    .qr-info-title {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 4px;
        font-size: 15px;
    }

    .qr-info-text {
        color: var(--text-secondary);
        font-size: 13px;
        margin-bottom: 8px;
    }

    .qr-info-note {
        font-size: 12px;
        color: var(--text-tertiary);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .qr-info-note i {
        color: var(--success);
    }

    /* Ticket Footer */
    .ticket-footer {
        background: var(--off-white);
        padding: 24px 40px;
        border-top: 1px dashed var(--border);
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
        width: 40px;
        height: 40px;
        background: var(--success-soft);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--success);
        font-size: 18px;
    }

    .ticket-footer-text {
        display: flex;
        flex-direction: column;
    }

    .ticket-footer-text strong {
        font-size: 14px;
        color: var(--text-primary);
    }

    .ticket-footer-text span {
        font-size: 12px;
        color: var(--text-tertiary);
    }

    .ticket-footer-right {
        font-family: 'Inter', monospace;
        font-size: 13px;
        color: var(--text-secondary);
        letter-spacing: 0.02em;
    }

    /* Terms */
    .ticket-terms {
        margin-top: 24px;
        padding: 16px;
        background: var(--off-white);
        border-radius: var(--radius-md);
        border: 1px solid var(--border);
        font-size: 12px;
        color: var(--text-tertiary);
        text-align: center;
    }

    /* Print Styles */
    @media print {
        .d-print-none {
            display: none !important;
        }

        body {
            background: white;
            padding: 0;
        }

        .ticket-container {
            margin: 0;
        }

        .ticket {
            box-shadow: none;
            border: 1px solid #ddd;
        }

        .ticket-header-gradient {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .status-badge,
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
        .ticket-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-back,
        .btn-print {
            justify-content: center;
        }

        .ticket-header-gradient {
            padding: 30px 24px;
        }

        .ticket-title {
            font-size: 28px;
        }

        .ticket-body {
            padding: 24px;
        }

        .event-details-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .attendee-details {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .order-summary-box {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .qr-section {
            flex-direction: column;
            text-align: center;
            gap: 16px;
        }

        .ticket-footer {
            flex-direction: column;
            text-align: center;
            padding: 20px;
        }

        .ticket-footer-left {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')

<div class="container-custom">
    {{-- Ticket Actions --}}
    <div class="ticket-header d-print-none">
        <div class="ticket-actions">
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

    {{-- Ticket Container --}}
    <div class="ticket-container">
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
                    {{ config('app.name') }} · E-Ticket
                </div>
            </div>

            {{-- Ticket Body --}}
            <div class="ticket-body">
                {{-- Event Details Grid --}}
                <div class="event-details-grid">
                    <div class="event-detail-item">
                        <div class="event-detail-icon">
                            <i class="bi bi-calendar"></i>
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
                            <span class="event-detail-value">{{ $order->ticket->event->location ?? 'TBA' }}</span>
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
                        <span class="order-summary-value">{{ ucfirst(str_replace('_', ' ', $order->payment->payment_method ?? 'cash')) }}</span>
                    </div>
                    <div class="order-summary-item">
                        <span class="order-summary-label">Total</span>
                        <span class="order-summary-value highlight">${{ number_format($order->payment->amount ?? 0, 2) }}</span>
                    </div>
                </div>

                {{-- QR Code Section --}}
                <div class="qr-section">
                    <div class="qr-code">
                        <i class="bi bi-qr-code"></i>
                    </div>
                    <div class="qr-info">
                        <div class="qr-info-title">Digital Ticket</div>
                        <p class="qr-info-text">Scan this QR code at the venue entrance for quick verification.</p>
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
                    <i class="bi bi-clock-history me-1"></i>
                    Purchased: {{ \Carbon\Carbon::parse($order->created_at ?? now())->format('M d, Y') }}
                </div>
            </div>

            {{-- Terms --}}
            <div class="ticket-terms">
                <i class="bi bi-info-circle me-1"></i>
                This ticket is non-refundable and non-transferable. Please present this ticket (digital or printed) at the venue entrance.
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add print optimization
        window.onbeforeprint = function() {
            document.querySelector('.ticket').style.boxShadow = 'none';
        };
        
        window.onafterprint = function() {
            document.querySelector('.ticket').style.boxShadow = '';
        };
    });
</script>
@endpush