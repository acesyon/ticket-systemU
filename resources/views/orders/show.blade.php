@extends('layouts.app')

@section('title', 'Order Details')

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
        --warning-soft: #fef3c7;
        --error: #ef4444;
        --error-soft: #fee9e7;
        --info: #3b82f6;
        --info-soft: #dbeafe;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.02), 0 1px 2px rgba(0,0,0,0.02);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.01);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.02), 0 4px 6px -2px rgba(0,0,0,0.01);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
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
    .order-header {
        padding: 60px 0 32px;
        background: linear-gradient(to bottom, var(--white), var(--off-white));
        border-bottom: 1px solid var(--border);
    }

    .order-header-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap;
    }

    .order-header-left {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .order-header-eyebrow {
        display: inline-block;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--accent);
        background: var(--accent-soft);
        padding: 6px 14px;
        border-radius: 100px;
        width: fit-content;
    }

    .order-header h1 {
        font-size: clamp(28px, 3vw, 36px);
        font-weight: 700;
        color: var(--text-primary);
        letter-spacing: -0.02em;
        line-height: 1.2;
        margin: 0;
    }

    .order-header h1 span {
        color: var(--text-tertiary);
        font-weight: 400;
        margin-left: 8px;
    }

    .order-header h1 em {
        font-style: normal;
        color: var(--accent);
    }

    .order-header-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 100px;
        font-size: 13px;
        font-weight: 500;
        width: fit-content;
    }

    .status-badge::before {
        content: '';
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }

    .status-badge.completed {
        background: var(--success-soft);
        color: var(--success);
    }

    .status-badge.completed::before {
        background: var(--success);
    }

    .status-badge.pending {
        background: var(--warning-soft);
        color: var(--warning);
    }

    .status-badge.pending::before {
        background: var(--warning);
    }

    .status-badge.cancelled,
    .status-badge.failed {
        background: var(--error-soft);
        color: var(--error);
    }

    .status-badge.cancelled::before,
    .status-badge.failed::before {
        background: var(--error);
    }

    /* Layout */
    .order-layout {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 32px;
        align-items: start;
        margin: 32px 0 60px;
    }

    /* Cards */
    .order-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        margin-bottom: 24px;
    }

    .order-card:last-child {
        margin-bottom: 0;
    }

    .order-card-header {
        padding: 20px 24px;
        background: var(--off-white);
        border-bottom: 1px solid var(--border);
    }

    .order-card-header h5 {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .order-card-header h5 i {
        color: var(--accent);
        font-size: 18px;
    }

    .order-card-body {
        padding: 24px;
    }

    /* Event Title */
    .event-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 20px;
        line-height: 1.3;
    }

    /* Event Details Grid */
    .event-details-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 24px;
    }

    .event-detail-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .event-detail-icon {
        width: 40px;
        height: 40px;
        background: var(--accent-soft);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        font-size: 18px;
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
        font-size: 15px;
    }

    /* Description */
    .event-description {
        margin-top: 24px;
        padding-top: 24px;
        border-top: 1px solid var(--border);
    }

    .event-description-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-tertiary);
        text-transform: uppercase;
        letter-spacing: 0.03em;
        margin-bottom: 12px;
        display: block;
    }

    .event-description-text {
        color: var(--text-secondary);
        font-size: 14px;
        line-height: 1.6;
    }

    /* Order Summary Card */
    .order-summary-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        position: sticky;
        top: 100px;
    }

    .order-summary-header {
        padding: 20px 24px;
        background: var(--off-white);
        border-bottom: 1px solid var(--border);
    }

    .order-summary-header h5 {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .order-summary-header h5 i {
        color: var(--success);
        font-size: 18px;
    }

    .order-summary-body {
        padding: 24px;
    }

    /* Summary Table */
    .summary-table {
        width: 100%;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px dashed var(--border);
    }

    .summary-row:last-child {
        border-bottom: none;
    }

    .summary-label {
        color: var(--text-secondary);
        font-size: 14px;
    }

    .summary-value {
        font-weight: 500;
        color: var(--text-primary);
        font-size: 14px;
    }

    .summary-value.id {
        font-family: 'Inter', monospace;
        letter-spacing: 0.02em;
    }

    .summary-row.highlight {
        background: var(--off-white);
        padding: 16px;
        border-radius: var(--radius-sm);
        margin-top: 8px;
        border-bottom: none;
    }

    .summary-row.highlight .summary-label {
        font-weight: 600;
        color: var(--text-primary);
    }

    .summary-row.highlight .summary-value {
        font-weight: 700;
        color: var(--success);
        font-size: 18px;
    }

    /* Action Buttons */
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

    .btn-download {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: var(--success);
        border: none;
        border-radius: var(--radius-sm);
        color: white;
        font-weight: 500;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-download:hover {
        background: #0f9f6e;
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-download i {
        transition: transform 0.2s;
    }

    .btn-download:hover i {
        transform: translateY(-2px);
    }

    /* QR Code Section (if needed) */
    .qr-section {
        margin-top: 24px;
        padding-top: 24px;
        border-top: 1px solid var(--border);
        text-align: center;
    }

    .qr-placeholder {
        width: 120px;
        height: 120px;
        background: var(--off-white);
        border: 1px solid var(--border);
        margin: 0 auto 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-tertiary);
        font-size: 40px;
    }

    .qr-label {
        font-size: 12px;
        color: var(--text-tertiary);
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

    .anim {
        opacity: 0;
        animation: fadeUp 0.6s ease forwards;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .order-layout {
            grid-template-columns: 1fr;
        }

        .order-summary-card {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .container-custom {
            padding: 0 20px;
        }

        .order-header {
            padding: 40px 0 24px;
        }

        .order-header-inner {
            flex-direction: column;
            align-items: flex-start;
        }

        .order-header-actions {
            width: 100%;
        }

        .btn-back,
        .btn-download {
            flex: 1;
            justify-content: center;
        }

        .event-details-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
    }
</style>
@endpush

@section('content')

{{-- Page Header --}}
<div class="order-header">
    <div class="container-custom">
        <div class="order-header-inner">
            <div class="order-header-left">
                <span class="order-header-eyebrow">Order Information</span>
                <h1>
                    Order <em>Details</em>
                    <span>#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                </h1>
            </div>
            
            <div class="order-header-actions">
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

<div class="container-custom">
    <div class="order-layout">
        {{-- Main Content - Event Information --}}
        <div class="order-main">
            <div class="order-card anim">
                <div class="order-card-header">
                    <h5>
                        <i class="bi bi-calendar-event"></i>
                        Event Information
                    </h5>
                </div>
                <div class="order-card-body">
                    <h3 class="event-title">{{ $order->ticket->event->name ?? 'Event' }}</h3>

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
                            <span class="event-description-label">About the Event</span>
                            <p class="event-description-text">{{ $order->ticket->event->description }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Additional Information Card (if needed) --}}
            <div class="order-card anim" style="animation-delay: 0.1s">
                <div class="order-card-header">
                    <h5>
                        <i class="bi bi-info-circle"></i>
                        Additional Information
                    </h5>
                </div>
                <div class="order-card-body">
                    <div style="display: flex; align-items: flex-start; gap: 12px;">
                        <i class="bi bi-shield-check" style="color: var(--success); font-size: 20px;"></i>
                        <div>
                            <p style="color: var(--text-secondary); font-size: 14px; margin-bottom: 8px;">
                                <strong>Ticket Policy:</strong> This ticket is non-refundable and non-transferable.
                            </p>
                            <p style="color: var(--text-secondary); font-size: 14px; margin: 0;">
                                <strong>Entry:</strong> Please present this ticket (digital or printed) at the venue entrance.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar - Order Summary --}}
        <div class="order-sidebar">
            <div class="order-summary-card anim" style="animation-delay: 0.15s">
                <div class="order-summary-header">
                    <h5>
                        <i class="bi bi-receipt"></i>
                        Order Summary
                    </h5>
                </div>
                <div class="order-summary-body">
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
                            <span class="summary-value">{{ $order->quantity }}</span>
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
                                {{ ucfirst(str_replace('_', ' ', $order->payment->payment_method ?? 'cash')) }}
                            </span>
                        </div>

                        <div class="summary-row">
                            <span class="summary-label">Date Purchased</span>
                            <span class="summary-value">
                                {{ \Carbon\Carbon::parse($order->created_at ?? now())->format('M d, Y h:i A') }}
                            </span>
                        </div>

                        <div class="summary-row highlight">
                            <span class="summary-label">Total Amount</span>
                            <span class="summary-value">
                                ${{ number_format($order->payment->amount ?? 0, 2) }}
                            </span>
                        </div>
                    </div>

                    {{-- QR Code Placeholder (optional) --}}
                    <div class="qr-section">
                        <div class="qr-placeholder">
                            <i class="bi bi-qr-code"></i>
                        </div>
                        <p class="qr-label">Scan for entry verification</p>
                    </div>
                </div>
            </div>

            {{-- Venue Info Card --}}
            <div class="order-card" style="margin-top: 16px; background: var(--off-white);">
                <div class="order-card-body" style="padding: 16px;">
                    <div style="display: flex; align-items: flex-start; gap: 12px;">
                        <i class="bi bi-building" style="color: var(--accent); font-size: 18px;"></i>
                        <div>
                            <p style="color: var(--text-primary); font-size: 13px; font-weight: 600; margin-bottom: 4px;">Venue Information</p>
                            <p style="color: var(--text-secondary); font-size: 12px; margin: 0;">
                                {{ $order->ticket->event->venue ?? $order->ticket->event->location ?? 'TBA' }}<br>
                                Doors open 1 hour before event
                            </p>
                        </div>
                    </div>
                </div>
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
                    entry.target.classList.add('anim');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        document.querySelectorAll('.anim:not(.anim)').forEach(el => observer.observe(el));
    });
</script>
@endpush