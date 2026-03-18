@extends('layouts.app')

@section('title', 'Order Successful')

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
        background: linear-gradient(135deg, var(--success) 0%, #34d399 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Page Header */
    .success-header {
        padding: 60px 0 32px;
        background: linear-gradient(to bottom, var(--white), var(--off-white));
        border-bottom: 1px solid var(--border);
        text-align: center;
    }

    .success-header-eyebrow {
        display: inline-block;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--success);
        background: var(--success-soft);
        padding: 6px 14px;
        border-radius: 100px;
        margin-bottom: 20px;
    }

    .success-header h1 {
        font-size: clamp(36px, 4vw, 48px);
        font-weight: 700;
        color: var(--text-primary);
        letter-spacing: -0.02em;
        line-height: 1.1;
    }

    .success-header h1 em {
        font-style: normal;
        color: var(--success);
    }

    /* Success Card */
    .success-card {
        max-width: 800px;
        margin: 40px auto 60px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .success-card-header {
        padding: 32px 40px;
        background: linear-gradient(135deg, var(--success) 0%, #34d399 100%);
        text-align: center;
    }

    .success-card-header i {
        font-size: 64px;
        color: white;
        margin-bottom: 16px;
        display: inline-block;
    }

    .success-card-header h2 {
        font-size: 28px;
        font-weight: 700;
        color: white;
        margin-bottom: 8px;
    }

    .success-card-header p {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
    }

    .success-card-body {
        padding: 40px;
    }

    /* Success Icon */
    .success-icon-wrapper {
        display: flex;
        justify-content: center;
        margin-bottom: 24px;
    }

    .success-icon-circle {
        width: 96px;
        height: 96px;
        background: var(--success-soft);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .success-icon-circle i {
        font-size: 48px;
        color: var(--success);
    }

    .success-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
        text-align: center;
    }

    .success-subtitle {
        font-size: 16px;
        color: var(--text-secondary);
        text-align: center;
        margin-bottom: 32px;
    }

    /* Order Details Card */
    .order-details-card {
        background: var(--off-white);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 28px;
        margin-bottom: 32px;
    }

    .order-details-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .order-detail-item {
        text-align: center;
    }

    .order-detail-label {
        font-size: 13px;
        font-weight: 500;
        color: var(--text-tertiary);
        text-transform: uppercase;
        letter-spacing: 0.03em;
        margin-bottom: 8px;
        display: block;
    }

    .order-detail-value {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-primary);
    }

    .order-detail-value.highlight {
        color: var(--success);
        font-size: 22px;
        font-weight: 700;
    }

    .order-detail-value.id {
        font-family: 'Inter', monospace;
        letter-spacing: 0.02em;
    }

    /* Divider */
    .divider {
        display: flex;
        align-items: center;
        gap: 16px;
        margin: 24px 0;
        color: var(--text-tertiary);
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .divider-line {
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    /* Ticket Summary */
    .ticket-summary {
        margin: 24px 0;
    }

    .ticket-summary-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .ticket-summary-title i {
        color: var(--accent);
    }

    .ticket-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px dashed var(--border);
    }

    .ticket-item:last-child {
        border-bottom: none;
    }

    .ticket-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .ticket-name {
        font-weight: 500;
        color: var(--text-primary);
        font-size: 14px;
    }

    .ticket-type {
        font-size: 12px;
        color: var(--text-tertiary);
    }

    .ticket-quantity {
        font-size: 13px;
        color: var(--text-secondary);
    }

    .ticket-subtotal {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 14px;
    }

    /* Multiple Orders Section */
    .multiple-orders {
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid var(--border);
    }

    .multiple-orders-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .multiple-orders-title i {
        color: var(--accent);
    }

    .order-summary-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        margin-bottom: 8px;
    }

    .order-summary-item:last-child {
        margin-bottom: 0;
    }

    .order-summary-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .order-summary-event {
        font-weight: 500;
        color: var(--text-primary);
        font-size: 14px;
    }

    .order-summary-meta {
        font-size: 12px;
        color: var(--text-tertiary);
    }

    .order-summary-amount {
        font-weight: 600;
        color: var(--success);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 32px;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 28px;
        background: var(--accent);
        color: white;
        border: none;
        border-radius: var(--radius-sm);
        font-weight: 500;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-primary:hover {
        background: var(--accent-light);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-success {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 28px;
        background: var(--success);
        color: white;
        border: none;
        border-radius: var(--radius-sm);
        font-weight: 500;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-success:hover {
        background: #0f9f6e;
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 28px;
        background: var(--white);
        color: var(--text-secondary);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        font-weight: 500;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-secondary:hover {
        border-color: var(--accent);
        color: var(--accent);
        background: var(--off-white);
    }

    .btn-secondary i,
    .btn-primary i,
    .btn-success i {
        transition: transform 0.2s;
    }

    .btn-secondary:hover i,
    .btn-primary:hover i,
    .btn-success:hover i {
        transform: translateX(4px);
    }

    /* Security Note */
    .security-note {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid var(--border);
        color: var(--text-tertiary);
        font-size: 13px;
    }

    .security-note i {
        color: var(--success);
        font-size: 16px;
    }

    /* Animations */
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

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

    .anim-scale {
        opacity: 0;
        animation: scaleIn 0.5s cubic-bezier(0.2, 0, 0, 1) forwards;
    }

    .anim-fade {
        opacity: 0;
        animation: fadeUp 0.6s ease forwards;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container-custom {
            padding: 0 20px;
        }

        .success-card-header {
            padding: 24px 20px;
        }

        .success-card-body {
            padding: 24px 20px;
        }

        .order-details-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .order-detail-item {
            text-align: left;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-detail-label {
            margin-bottom: 0;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-primary,
        .btn-success,
        .btn-secondary {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')

{{-- Page Header --}}
<div class="success-header">
    <div class="container-custom">
        <span class="success-header-eyebrow">Order Confirmed</span>
        <h1>Payment <em class="text-gradient">Successful</em></h1>
    </div>
</div>

<div class="container-custom">
    <div class="success-card anim-scale">
        {{-- Card Header with Gradient --}}
        <div class="success-card-header">
            <i class="bi bi-check-circle-fill"></i>
            <h2>Thank You for Your Purchase!</h2>
            <p>Your order has been confirmed and tickets are ready</p>
        </div>

        {{-- Card Body --}}
        <div class="success-card-body">
            {{-- Success Icon --}}
            <div class="success-icon-wrapper anim-fade" style="animation-delay: 0.1s">
                <div class="success-icon-circle">
                    <i class="bi bi-check-lg"></i>
                </div>
            </div>

            <h3 class="success-title anim-fade" style="animation-delay: 0.15s">Payment Successful!</h3>
            <p class="success-subtitle anim-fade" style="animation-delay: 0.2s">We've sent a confirmation to your email</p>

            {{-- Order Details Card --}}
            <div class="order-details-card anim-fade" style="animation-delay: 0.25s">
                <div class="order-details-grid">
                    <div class="order-detail-item">
                        <span class="order-detail-label">Order ID</span>
                        <span class="order-detail-value id">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    
                    <div class="order-detail-item">
                        <span class="order-detail-label">Total Amount</span>
                        <span class="order-detail-value highlight">
                            ${{ number_format($order->payment->amount ?? 0, 2) }}
                        </span>
                    </div>
                    
                    <div class="order-detail-item">
                        <span class="order-detail-label">Payment Method</span>
                        <span class="order-detail-value">
                            @if(isset($order->payment->payment_method))
                                {{ ucfirst(str_replace('_', ' ', $order->payment->payment_method)) }}
                            @else
                                Cash
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            {{-- Ticket Summary --}}
            <div class="divider anim-fade" style="animation-delay: 0.3s">
                <span class="divider-line"></span>
                <span>Ticket Details</span>
                <span class="divider-line"></span>
            </div>

            <div class="ticket-summary anim-fade" style="animation-delay: 0.35s">
                <div class="ticket-summary-title">
                    <i class="bi bi-ticket-perforated"></i>
                    Your Ticket
                </div>
                
                <div class="ticket-item">
                    <div class="ticket-info">
                        <span class="ticket-name">{{ $order->ticket->event->name ?? 'Event' }}</span>
                        <span class="ticket-type">{{ $order->ticket->ticket_type ?? 'Standard' }}</span>
                        <span class="ticket-quantity">Quantity: {{ $order->quantity }}</span>
                    </div>
                    <span class="ticket-subtotal">
                        ${{ number_format($order->payment->amount ?? 0, 2) }}
                    </span>
                </div>
            </div>

            {{-- Multiple Orders Section (if there are more from same session) --}}
            @if(isset($recentOrders) && $recentOrders->count() > 1)
                <div class="multiple-orders anim-fade" style="animation-delay: 0.4s">
                    <div class="multiple-orders-title">
                        <i class="bi bi-layers"></i>
                        Other Items in This Order
                    </div>
                    
                    @foreach($recentOrders as $recentOrder)
                        @if($recentOrder->id != $order->id)
                            <div class="order-summary-item">
                                <div class="order-summary-info">
                                    <span class="order-summary-event">{{ $recentOrder->ticket->event->name ?? 'Event' }}</span>
                                    <span class="order-summary-meta">
                                        {{ $recentOrder->ticket->ticket_type ?? 'Standard' }} × {{ $recentOrder->quantity }}
                                    </span>
                                </div>
                                <span class="order-summary-amount">
                                    ${{ number_format($recentOrder->payment->amount ?? 0, 2) }}
                                </span>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

            {{-- Action Buttons --}}
            <div class="action-buttons anim-fade" style="animation-delay: 0.45s">
                <a href="{{ route('orders.show', $order) }}" class="btn-primary">
                    <i class="bi bi-eye"></i>
                    View Order
                </a>
                <a href="{{ route('orders.download', $order) }}" class="btn-success">
                    <i class="bi bi-download"></i>
                    Download Ticket
                </a>
                <a href="{{ route('events.index') }}" class="btn-secondary">
                    <i class="bi bi-calendar-event"></i>
                    Browse More Events
                </a>
            </div>

            {{-- Security Note --}}
            <div class="security-note anim-fade" style="animation-delay: 0.5s">
                <i class="bi bi-envelope-paper"></i>
                <span>A confirmation email has been sent to your inbox</span>
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
                    entry.target.classList.add('anim-fade', 'anim-scale');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        document.querySelectorAll('.anim-fade, .anim-scale').forEach(el => observer.observe(el));
    });
</script>
@endpush