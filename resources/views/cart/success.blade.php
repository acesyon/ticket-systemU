@extends('layouts.app')

@section('title', 'Order Successful')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,600;0,9..144,700;1,9..144,300&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* ═══════════════════════════════════════════════════════════════════════════
   TOKENS — consistent with home, cart & checkout pages
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
   PAGE HEADER — elegant with gold accent
═══════════════════════════════════════════════════════════════════════════ */
.success-header {
    background: var(--ink);
    padding: 64px 0 56px;
    position: relative;
    overflow: hidden;
}

.success-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
    background-size: 32px 32px;
    pointer-events: none;
}

.success-header::after {
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
    margin-bottom: 20px;
}

.header-eyebrow::before {
    content: '';
    display: block;
    width: 24px;
    height: 1px;
    background: var(--gold);
}

.success-header h1 {
    font-family: var(--f-display);
    font-size: clamp(48px, 6vw, 72px);
    font-weight: 600;
    line-height: 1.0;
    letter-spacing: -0.03em;
    color: var(--white);
}

.success-header h1 em {
    font-style: italic;
    font-weight: 300;
    color: var(--gold);
}

/* ═══════════════════════════════════════════════════════════════════════════
   SUCCESS CARD
═══════════════════════════════════════════════════════════════════════════ */
.success-card {
    max-width: 880px;
    margin: 48px auto 80px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    box-shadow: var(--shadow-card);
}

/* Success header inside card */
.card-success-header {
    background: linear-gradient(135deg, var(--success) 0%, #3d9a78 100%);
    padding: 48px 40px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.card-success-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    border-radius: 50%;
}

.card-success-header i {
    font-size: 72px;
    color: white;
    margin-bottom: 20px;
    display: inline-block;
    filter: drop-shadow(0 4px 12px rgba(0,0,0,0.1));
}

.card-success-header h2 {
    font-family: var(--f-display);
    font-size: 32px;
    font-weight: 600;
    color: white;
    margin-bottom: 12px;
    letter-spacing: -0.02em;
}

.card-success-header p {
    font-size: 15px;
    color: rgba(255,255,255,0.9);
    margin: 0;
}

/* Card body */
.success-card-body {
    padding: 48px;
}

/* Success icon wrapper */
.success-icon-wrapper {
    display: flex;
    justify-content: center;
    margin-bottom: 28px;
}

.success-icon-circle {
    width: 88px;
    height: 88px;
    background: var(--success-soft);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(45, 122, 95, 0.2);
}

.success-icon-circle i {
    font-size: 44px;
    color: var(--success);
}

.success-title {
    font-family: var(--f-display);
    font-size: 28px;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 8px;
    text-align: center;
    letter-spacing: -0.02em;
}

.success-subtitle {
    font-size: 15px;
    color: var(--text-muted);
    text-align: center;
    margin-bottom: 36px;
}

/* Order details card */
.order-details-card {
    background: var(--mist-2);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    padding: 32px;
    margin-bottom: 36px;
}

.order-details-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 32px;
}

.order-detail-item {
    text-align: center;
}

.order-detail-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 8px;
    display: block;
}

.order-detail-value {
    font-family: var(--f-display);
    font-size: 20px;
    font-weight: 600;
    color: var(--ink);
}

.order-detail-value.highlight {
    color: var(--success);
    font-size: 26px;
}

.order-detail-value.id {
    font-family: var(--f-body);
    letter-spacing: 0.02em;
}

/* Divider */
.divider {
    display: flex;
    align-items: center;
    gap: 16px;
    margin: 28px 0 24px;
    color: var(--text-muted);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
}

.divider-line {
    flex: 1;
    height: 1px;
    background: var(--border);
}

/* Ticket summary */
.ticket-summary {
    margin: 24px 0;
}

.ticket-summary-title {
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.ticket-summary-title i {
    color: var(--gold);
    font-size: 14px;
}

.ticket-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 0;
    border-bottom: 1px solid var(--border);
}

.ticket-item:last-child {
    border-bottom: none;
}

.ticket-info {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.ticket-name {
    font-family: var(--f-display);
    font-size: 17px;
    font-weight: 600;
    color: var(--ink);
    letter-spacing: -0.02em;
}

.ticket-type {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--gold-soft);
    padding: 4px 12px;
    border-radius: 100px;
    font-size: 11px;
    font-weight: 600;
    color: #8a6a1a;
    width: fit-content;
}

.ticket-type i {
    font-size: 10px;
}

.ticket-quantity {
    font-size: 13px;
    color: var(--text-muted);
}

.ticket-subtotal {
    font-family: var(--f-display);
    font-size: 22px;
    font-weight: 600;
    color: var(--success);
}

/* Multiple orders section */
.multiple-orders {
    margin-top: 36px;
    padding-top: 28px;
    border-top: 1px solid var(--border);
}

.multiple-orders-title {
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.multiple-orders-title i {
    color: var(--gold);
}

.order-summary-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 16px;
    background: var(--mist);
    border: 1px solid var(--border);
    border-radius: var(--r-md);
    margin-bottom: 10px;
    transition: all 0.2s;
}

.order-summary-item:hover {
    border-color: var(--gold);
    background: var(--white);
}

.order-summary-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.order-summary-event {
    font-family: var(--f-display);
    font-size: 15px;
    font-weight: 600;
    color: var(--ink);
}

.order-summary-meta {
    font-size: 12px;
    color: var(--text-muted);
}

.order-summary-amount {
    font-family: var(--f-display);
    font-size: 18px;
    font-weight: 600;
    color: var(--success);
}

/* Action buttons */
.action-buttons {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 40px;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--ink);
    color: var(--white);
    font-weight: 600;
    font-size: 14px;
    padding: 14px 28px;
    border-radius: var(--r-md);
    text-decoration: none;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
}

.btn-primary:hover {
    background: var(--ink-3);
    transform: translateY(-2px);
    box-shadow: var(--shadow-lift);
    color: var(--white);
}

.btn-success {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--success);
    color: white;
    font-weight: 600;
    font-size: 14px;
    padding: 14px 28px;
    border-radius: var(--r-md);
    text-decoration: none;
    transition: all 0.2s;
}

.btn-success:hover {
    background: #236b52;
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(45, 122, 95, 0.3);
}

.btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: transparent;
    color: var(--text-muted);
    font-weight: 500;
    font-size: 14px;
    padding: 14px 28px;
    border-radius: var(--r-md);
    text-decoration: none;
    border: 1px solid var(--border);
    transition: all 0.2s;
}

.btn-secondary:hover {
    border-color: var(--gold);
    color: var(--gold);
    background: var(--gold-soft);
}

.btn-primary i,
.btn-success i,
.btn-secondary i {
    transition: transform 0.2s;
}

.btn-primary:hover i,
.btn-success:hover i,
.btn-secondary:hover i {
    transform: translateX(4px);
}

/* Security note */
.security-note {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 36px;
    padding-top: 28px;
    border-top: 1px solid var(--border);
    color: var(--text-muted);
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
        transform: scale(0.96);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

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

.anim-scale {
    opacity: 0;
    animation: scaleIn 0.5s cubic-bezier(0.22, 1, 0.36, 1) forwards;
}

.anim-fade {
    opacity: 0;
    animation: fadeUp 0.6s cubic-bezier(0.22, 1, 0.36, 1) forwards;
}

/* Responsive */
@media (max-width: 768px) {
    .wrap {
        padding: 0 20px;
    }
    
    .success-header {
        padding: 48px 0 40px;
    }
    
    .success-card {
        margin: 32px auto 60px;
    }
    
    .card-success-header {
        padding: 36px 24px;
    }
    
    .card-success-header i {
        font-size: 56px;
    }
    
    .card-success-header h2 {
        font-size: 26px;
    }
    
    .success-card-body {
        padding: 32px 24px;
    }
    
    .order-details-grid {
        grid-template-columns: 1fr;
        gap: 20px;
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
    
    .order-detail-value.highlight {
        font-size: 22px;
    }
    
    .ticket-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
    
    .ticket-subtotal {
        align-self: flex-end;
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
    
    .order-summary-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .order-summary-amount {
        align-self: flex-end;
    }
}

@media (max-width: 480px) {
    .success-title {
        font-size: 24px;
    }
    
    .success-subtitle {
        font-size: 14px;
    }
    
    .order-detail-value {
        font-size: 16px;
    }
    
    .ticket-name {
        font-size: 15px;
    }
    
    .ticket-subtotal {
        font-size: 18px;
    }
}
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════════════════════════════════════
     HERO SECTION — matches home, cart & checkout
═══════════════════════════════════════════════════════════════════════════ --}}
<div class="success-header">
    <div class="wrap">
        <div class="header-eyebrow">Order Confirmed</div>
        <h1>Payment <em>Successful</em></h1>
    </div>
</div>

<div class="wrap">
    <div class="success-card anim-scale">
        
        {{-- Card Header with Gold Accent --}}
        <div class="card-success-header">
            <i class="bi bi-check-circle-fill"></i>
            <h2>Thank You for Your Purchase!</h2>
            <p>Your order has been confirmed and tickets are ready</p>
        </div>

        {{-- Card Body --}}
        <div class="success-card-body">
            
            {{-- Success Icon --}}
            <div class="success-icon-wrapper anim-fade" style="animation-delay: 0.05s">
                <div class="success-icon-circle">
                    <i class="bi bi-check-lg"></i>
                </div>
            </div>

            <h3 class="success-title anim-fade" style="animation-delay: 0.1s">Payment Successful!</h3>
            <p class="success-subtitle anim-fade" style="animation-delay: 0.15s">
                A confirmation has been sent to your email address
            </p>

            {{-- Order Details Card --}}
            <div class="order-details-card anim-fade" style="animation-delay: 0.2s">
                <div class="order-details-grid">
                    <div class="order-detail-item">
                        <span class="order-detail-label">Order ID</span>
                        <span class="order-detail-value id">
                            #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>
                    
                    <div class="order-detail-item">
                        <span class="order-detail-label">Total Amount</span>
                        <span class="order-detail-value highlight">
                            ${{ number_format($order->total_price ?? $order->payment->amount ?? 0, 2) }}
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

            {{-- Ticket Summary Section --}}
            <div class="divider anim-fade" style="animation-delay: 0.25s">
                <span class="divider-line"></span>
                <span>Ticket Details</span>
                <span class="divider-line"></span>
            </div>

            <div class="ticket-summary anim-fade" style="animation-delay: 0.3s">
                <div class="ticket-summary-title">
                    <i class="bi bi-ticket-perforated"></i>
                    Your Ticket
                </div>
                
                <div class="ticket-item">
                    <div class="ticket-info">
                        <span class="ticket-name">
                            {{ $order->ticket->event->name ?? 'Event' }}
                        </span>
                        <span class="ticket-type">
                            <i class="bi bi-ticket-perforated"></i>
                            {{ $order->ticket->ticket_type ?? 'Standard' }}
                        </span>
                        <span class="ticket-quantity">
                            Quantity: {{ $order->quantity }}
                        </span>
                    </div>
                    <span class="ticket-subtotal">
                        ${{ number_format(($order->total_price ?? $order->payment->amount ?? 0), 2) }}
                    </span>
                </div>
            </div>

            {{-- Multiple Orders Section (if there are more from same session) --}}
            @if(isset($recentOrders) && $recentOrders->count() > 1)
                <div class="multiple-orders anim-fade" style="animation-delay: 0.35s">
                    <div class="multiple-orders-title">
                        <i class="bi bi-layers"></i>
                        Other Items in This Order
                    </div>
                    
                    @foreach($recentOrders as $recentOrder)
                        @if($recentOrder->id != $order->id)
                            <div class="order-summary-item">
                                <div class="order-summary-info">
                                    <span class="order-summary-event">
                                        {{ $recentOrder->ticket->event->name ?? 'Event' }}
                                    </span>
                                    <span class="order-summary-meta">
                                        {{ $recentOrder->ticket->ticket_type ?? 'Standard' }} 
                                        × {{ $recentOrder->quantity }}
                                    </span>
                                </div>
                                <span class="order-summary-amount">
                                    ${{ number_format($recentOrder->total_price ?? $recentOrder->payment->amount ?? 0, 2) }}
                                </span>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

            {{-- Action Buttons --}}
            <div class="action-buttons anim-fade" style="animation-delay: 0.4s">
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
            <div class="security-note anim-fade" style="animation-delay: 0.45s">
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
    // Intersection Observer for scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.05, rootMargin: '0px 0px -30px 0px' });

    document.querySelectorAll('.anim-fade, .anim-scale').forEach(el => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });
});
</script>
@endpush