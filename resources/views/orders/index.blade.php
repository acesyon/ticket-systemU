@extends('layouts.app')

@section('title', 'My Orders')

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
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 40px;
}

/* ═══════════════════════════════════════════════════════════════════════════
   PAGE HEADER
═══════════════════════════════════════════════════════════════════════════ */
.orders-header {
    background: var(--ink);
    padding: 64px 0 56px;
    position: relative;
    overflow: hidden;
}

.orders-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
    background-size: 32px 32px;
    pointer-events: none;
}

.orders-header::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--gold), transparent);
}

.header-inner {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 24px;
    flex-wrap: wrap;
    position: relative;
    z-index: 1;
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

.orders-header h1 {
    font-family: var(--f-display);
    font-size: clamp(48px, 6vw, 72px);
    font-weight: 600;
    line-height: 1.0;
    letter-spacing: -0.03em;
    color: var(--white);
}

.orders-header h1 em {
    font-style: italic;
    font-weight: 300;
    color: var(--gold);
}

.header-stats {
    text-align: right;
    flex-shrink: 0;
}

.header-stats-num {
    font-family: var(--f-display);
    font-size: 44px;
    font-weight: 600;
    color: var(--gold);
    line-height: 1;
    margin-bottom: 4px;
}

.header-stats-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.4);
}

/* ═══════════════════════════════════════════════════════════════════════════
   ALERT
═══════════════════════════════════════════════════════════════════════════ */
.orders-alert {
    display: flex;
    align-items: center;
    gap: 12px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-md);
    padding: 16px 24px;
    margin: 32px 0 24px;
    box-shadow: var(--shadow-card);
    border-left: 3px solid var(--success);
}

.orders-alert i {
    font-size: 20px;
    color: var(--success);
}

.orders-alert-content {
    flex: 1;
    font-size: 14px;
    font-weight: 500;
    color: var(--ink);
}

.orders-alert-close {
    background: none;
    border: none;
    font-size: 18px;
    color: var(--text-muted);
    cursor: pointer;
    padding: 4px;
    transition: color 0.2s;
}

.orders-alert-close:hover {
    color: var(--ink);
}

/* ═══════════════════════════════════════════════════════════════════════════
   EMPTY STATE
═══════════════════════════════════════════════════════════════════════════ */
.empty-orders {
    text-align: center;
    padding: 100px 40px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    margin: 48px 0;
}

.empty-icon {
    width: 80px;
    height: 80px;
    background: var(--mist-2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
    font-size: 32px;
    color: var(--text-muted);
}

.empty-orders h3 {
    font-family: var(--f-display);
    font-size: 28px;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 12px;
}

.empty-orders p {
    color: var(--text-muted);
    margin-bottom: 32px;
    max-width: 380px;
    margin-left: auto;
    margin-right: auto;
}

.btn-gold {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--gold);
    color: var(--ink);
    font-weight: 600;
    font-size: 14px;
    padding: 14px 32px;
    border-radius: var(--r-md);
    text-decoration: none;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
}

.btn-gold:hover {
    background: var(--gold-light);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(201,168,76,0.25);
}

/* ═══════════════════════════════════════════════════════════════════════════
   ORDERS TABLE
═══════════════════════════════════════════════════════════════════════════ */
.orders-table-container {
    margin: 40px 0 60px;
}

/* Table Header */
.orders-table-head {
    display: grid;
    grid-template-columns: 100px 1.5fr 140px 80px 100px 100px 120px;
    padding: 16px 28px;
    background: var(--mist-2);
    border: 1px solid var(--border);
    border-radius: var(--r-lg) var(--r-lg) 0 0;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
    align-items: center;
}

/* Order Row Link */
.order-row-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

/* Order Row */
.order-row {
    display: grid;
    grid-template-columns: 100px 1.5fr 140px 80px 100px 100px 120px;
    padding: 20px 28px;
    border: 1px solid var(--border);
    border-top: none;
    align-items: center;
    transition: all 0.25s ease;
    background: var(--white);
    cursor: pointer;
    position: relative;
}

.order-row:last-child {
    border-radius: 0 0 var(--r-lg) var(--r-lg);
}

.order-row:hover {
    background: var(--mist);
    transform: translateX(4px);
    border-color: var(--gold);
    position: relative;
    z-index: 1;
}

/* Order ID */
.order-id {
    font-family: var(--f-body);
    font-size: 13px;
    font-weight: 600;
    color: var(--text-muted);
    letter-spacing: 0.02em;
}

.order-row:hover .order-id {
    color: var(--gold);
}

/* Event Name */
.order-event-name {
    font-family: var(--f-display);
    font-size: 16px;
    font-weight: 600;
    color: var(--ink);
    line-height: 1.4;
    padding-right: 16px;
    letter-spacing: -0.02em;
}

.order-row:hover .order-event-name {
    color: var(--gold);
}

/* Ticket Type */
.order-ticket-type {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--gold-soft);
    padding: 5px 12px;
    border-radius: 100px;
    font-size: 11px;
    font-weight: 600;
    color: #8a6a1a;
    width: fit-content;
    transition: all 0.2s;
}

.order-ticket-type i {
    font-size: 10px;
}

.order-row:hover .order-ticket-type {
    background: var(--gold);
    color: var(--ink);
}

/* Quantity */
.order-qty {
    font-weight: 600;
    color: var(--ink);
    font-size: 15px;
}

/* Amount */
.order-amount {
    font-weight: 700;
    color: var(--ink);
    font-size: 16px;
}

.order-row:hover .order-amount {
    color: var(--gold);
}

/* Status Badges */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 600;
    padding: 5px 14px;
    border-radius: 100px;
    width: fit-content;
    letter-spacing: 0.02em;
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

.order-row:hover .status-badge.completed {
    background: var(--success);
    color: white;
}

.order-row:hover .status-badge.pending {
    background: var(--warning);
    color: white;
}

.order-row:hover .status-badge.cancelled,
.order-row:hover .status-badge.failed {
    background: var(--error);
    color: white;
}

/* Date */
.order-date {
    font-size: 13px;
    color: var(--text-muted);
}

.order-row:hover .order-date {
    color: var(--ink);
}

/* View Indicator Arrow */
.order-row::after {
    content: '→';
    position: absolute;
    right: 28px;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0;
    color: var(--gold);
    font-weight: 600;
    font-size: 18px;
    transition: opacity 0.2s, transform 0.2s;
}

.order-row:hover::after {
    opacity: 1;
    transform: translateY(-50%) translateX(4px);
}

/* ═══════════════════════════════════════════════════════════════════════════
   PAGINATION
═══════════════════════════════════════════════════════════════════════════ */
.orders-pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 32px 0 20px;
    border-top: 1px solid var(--border);
    flex-wrap: wrap;
    gap: 20px;
}

.pagination-info {
    font-size: 13px;
    color: var(--text-muted);
}

.pagination {
    display: flex;
    gap: 6px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.page-item .page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-md);
    color: var(--text-body);
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
    padding: 0 12px;
}

.page-item .page-link:hover {
    border-color: var(--gold);
    color: var(--gold);
    background: var(--gold-soft);
    transform: translateY(-2px);
}

.page-item.active .page-link {
    background: var(--gold);
    border-color: var(--gold);
    color: var(--ink);
    font-weight: 600;
}

.page-item.disabled .page-link {
    opacity: 0.5;
    pointer-events: none;
    cursor: not-allowed;
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
@media (max-width: 1100px) {
    .orders-table-head,
    .order-row {
        grid-template-columns: 80px 1.3fr 120px 70px 90px 90px 100px;
        padding: 16px 20px;
        gap: 8px;
    }
    
    .order-event-name {
        font-size: 15px;
    }
}

@media (max-width: 900px) {
    .wrap {
        padding: 0 20px;
    }
    
    .orders-header {
        padding: 48px 0 40px;
    }
    
    .header-stats {
        display: none;
    }
    
    .orders-table-head {
        display: none;
    }
    
    .order-row-link {
        margin-bottom: 16px;
        display: block;
    }
    
    .order-row {
        display: block;
        padding: 24px;
        border-radius: var(--r-lg);
        border: 1px solid var(--border);
        background: var(--white);
        margin-bottom: 0;
    }
    
    .order-row::after {
        content: 'View Details →';
        position: static;
        transform: none;
        opacity: 1;
        color: var(--gold);
        font-weight: 600;
        font-size: 13px;
        text-align: right;
        margin-top: 16px;
        padding-top: 12px;
        border-top: 1px dashed var(--border);
        display: block;
    }
    
    .order-row:hover::after {
        transform: translateX(4px);
    }
    
    .order-row > div {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px dashed var(--border);
    }
    
    .order-row > div:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    
    .order-id::before {
        content: "Order ID:";
        color: var(--text-muted);
        font-size: 12px;
        font-weight: 500;
        margin-right: 12px;
    }
    
    .order-event-name {
        font-size: 15px;
        padding-right: 0;
    }
    
    .order-event-name::before {
        content: "Event:";
        color: var(--text-muted);
        font-size: 12px;
        font-weight: 500;
        margin-right: 12px;
    }
    
    .order-ticket-type {
        margin: 0;
    }
    
    .order-ticket-type::before {
        content: "Ticket:";
        color: var(--text-muted);
        font-size: 12px;
        font-weight: 500;
        margin-right: 12px;
        background: none;
        padding: 0;
    }
    
    .order-qty::before {
        content: "Quantity:";
        color: var(--text-muted);
        font-size: 12px;
        font-weight: 500;
        margin-right: 12px;
    }
    
    .order-amount::before {
        content: "Amount:";
        color: var(--text-muted);
        font-size: 12px;
        font-weight: 500;
        margin-right: 12px;
    }
    
    .status-badge {
        margin: 0;
    }
    
    .status-badge::before {
        content: "Status:";
        color: var(--text-muted);
        font-size: 12px;
        font-weight: 500;
        margin-right: 12px;
        background: none;
        width: auto;
        height: auto;
        display: inline;
    }
    
    .order-date::before {
        content: "Date:";
        color: var(--text-muted);
        font-size: 12px;
        font-weight: 500;
        margin-right: 12px;
    }
    
    .orders-pagination {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .order-row {
        padding: 20px;
    }
    
    .order-event-name {
        font-size: 14px;
    }
}
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════════════════════════════════════
     HEADER SECTION
═══════════════════════════════════════════════════════════════════════════ --}}
<div class="orders-header">
    <div class="wrap">
        <div class="header-inner">
            <div>
                <div class="header-eyebrow">Account</div>
                <h1>My <em>Orders</em></h1>
            </div>
            @if($orders->isNotEmpty())
                <div class="header-stats">
                    <div class="header-stats-num">{{ $orders->total() }}</div>
                    <div class="header-stats-label">Total Orders</div>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="wrap">

    {{-- Alert --}}
    @if(session('success'))
        <div class="orders-alert anim-fade">
            <i class="bi bi-check-circle-fill"></i>
            <span class="orders-alert-content">{{ session('success') }}</span>
            <button class="orders-alert-close" onclick="this.parentElement.remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    {{-- Empty State --}}
    @if($orders->isEmpty())
        <div class="empty-orders anim-fade">
            <div class="empty-icon">
                <i class="bi bi-receipt"></i>
            </div>
            <h3>No Orders Yet</h3>
            <p>You haven't placed any orders. Browse events and book your first ticket.</p>
            <a href="{{ route('events.index') }}" class="btn-gold">
                Browse Events <i class="bi bi-arrow-right"></i>
            </a>
        </div>

    @else
        {{-- Orders Table --}}
        <div class="orders-table-container">
            
            {{-- Table Header --}}
            <div class="orders-table-head anim-fade">
                <span>Order</span>
                <span>Event</span>
                <span>Ticket</span>
                <span>Qty</span>
                <span>Amount</span>
                <span>Status</span>
                <span>Date</span>
            </div>

            {{-- Order Rows --}}
            @foreach($orders as $order)
                <a href="{{ route('orders.show', $order) }}" class="order-row-link">
                    <div class="order-row anim-fade" style="animation-delay: {{ $loop->index * 0.03 }}s">
                        
                        <div class="order-id">
                            #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                        </div>

                        <div class="order-event-name">
                            {{ $order->ticket->event->name ?? 'Event' }}
                        </div>

                        <div>
                            <span class="order-ticket-type">
                                <i class="bi bi-ticket-perforated"></i>
                                {{ $order->ticket->ticket_type ?? 'Standard' }}
                            </span>
                        </div>

                        <div class="order-qty">
                            {{ $order->quantity }}
                        </div>

                        <div class="order-amount">
                            ${{ number_format($order->payment->amount ?? $order->total_price ?? 0, 2) }}
                        </div>

                        <div>
                            <span class="status-badge {{ strtolower($order->status) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                        <div class="order-date">
                            {{ \Carbon\Carbon::parse($order->date_purchased ?? $order->created_at)->format('M d, Y') }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($orders->hasPages())
            <div class="orders-pagination anim-fade">
                <span class="pagination-info">
                    Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} orders
                </span>
                {{ $orders->links() }}
            </div>
        @endif

    @endif

</div>

@endsection

@push('scripts')
<script>
(function() {
    // Auto-dismiss alerts
    setTimeout(() => {
        document.querySelectorAll('.orders-alert').forEach(alert => {
            alert.style.transition = 'opacity 0.4s ease';
            alert.style.opacity = '0';
            setTimeout(() => {
                if (alert.parentNode) alert.remove();
            }, 400);
        });
    }, 5000);

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