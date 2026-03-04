@extends('layouts.app')

@section('title', 'My Orders')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500;600&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

<style>
    :root {
        --ink:      #0a0a0f;
        --ink-2:    #13131a;
        --ink-3:    #1e1e28;
        --ink-4:    #2a2a38;
        --line:     #2e2e3e;
        --volt:     #c8f135;
        --volt-dim: #9fbd28;
        --chalk:    #f0ede6;
        --chalk-2:  #b8b4ac;
        --chalk-3:  #706c66;
        --red-hot:  #ff3f3f;
        --green-ok: #4cde80;
        --amber:    #f5a623;

        --font-display: 'Playfair Display', Georgia, serif;
        --font-body:    'DM Sans', sans-serif;
        --font-mono:    'Space Mono', monospace;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        background-color: var(--ink);
        color: var(--chalk);
        font-family: var(--font-body);
        -webkit-font-smoothing: antialiased;
    }

    body::before {
        content: '';
        position: fixed;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
        pointer-events: none;
        z-index: 9999;
        opacity: 0.6;
    }

    /* ── PAGE HEADER ── */
    .orders-header {
        background: var(--ink-2);
        border-bottom: 1px solid var(--line);
        padding: 56px 0 40px;
        margin-top: -24px;
    }

    .orders-header-inner {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap;
    }

    .orders-header-eyebrow {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--volt);
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .orders-header-eyebrow::before {
        content: '';
        display: inline-block;
        width: 28px; height: 2px;
        background: var(--volt);
    }

    .orders-header h1 {
        font-family: var(--font-display);
        font-size: clamp(2.4rem, 4vw, 3.8rem);
        font-weight: 900;
        color: var(--chalk);
        letter-spacing: -0.02em;
        line-height: 1.0;
    }

    .orders-header h1 em {
        font-style: italic;
        color: var(--volt);
    }

    .orders-header-meta {
        text-align: right;
        flex-shrink: 0;
    }

    .orders-count-num {
        font-family: var(--font-display);
        font-size: 2.8rem;
        font-weight: 900;
        color: var(--chalk);
        line-height: 1;
    }

    .orders-count-label {
        font-family: var(--font-mono);
        font-size: 0.6rem;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--chalk-3);
        margin-top: 5px;
    }

    /* ── ALERT ── */
    .orders-alert {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 20px;
        border: 1px solid rgba(76,222,128,0.3);
        background: rgba(76,222,128,0.06);
        color: var(--green-ok);
        font-size: 0.9rem;
        border-top: none;
    }

    .orders-alert-close {
        margin-left: auto;
        background: none;
        border: none;
        color: inherit;
        cursor: pointer;
        opacity: 0.6;
        font-size: 0.8rem;
        transition: opacity 0.2s;
    }

    .orders-alert-close:hover { opacity: 1; }

    /* ── EMPTY STATE ── */
    .orders-empty {
        padding: 100px 40px;
        text-align: center;
        border: 1px solid var(--line);
        border-top: none;
    }

    .orders-empty-icon {
        font-size: 3rem;
        color: var(--chalk-3);
        margin-bottom: 24px;
        display: block;
    }

    .orders-empty h3 {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 900;
        color: var(--chalk);
        margin-bottom: 10px;
    }

    .orders-empty p {
        color: var(--chalk-3);
        font-size: 0.95rem;
        margin-bottom: 32px;
    }

    /* ── TABLE HEADER ── */
    .orders-table-head {
        display: grid;
        grid-template-columns: 80px 1fr 140px 70px 110px 100px 100px 120px;
        padding: 14px 28px;
        background: var(--ink-2);
        border: 1px solid var(--line);
        border-top: none;
    }

    .orders-table-head span {
        font-family: var(--font-mono);
        font-size: 0.56rem;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--chalk-3);
    }

    /* ── ORDER ROW ── */
    .order-row {
        display: grid;
        grid-template-columns: 80px 1fr 140px 70px 110px 100px 100px 120px;
        padding: 22px 28px;
        border: 1px solid var(--line);
        border-top: none;
        align-items: center;
        transition: background 0.18s;
        gap: 0;
    }

    .order-row:hover { background: var(--ink-2); }

    /* Order ID */
    .order-id {
        font-family: var(--font-mono);
        font-size: 0.72rem;
        color: var(--chalk-3);
        letter-spacing: 0.08em;
    }

    /* Event name */
    .order-event-name {
        font-family: var(--font-display);
        font-size: 1rem;
        font-weight: 700;
        color: var(--chalk);
        line-height: 1.2;
        letter-spacing: -0.01em;
        padding-right: 16px;
    }

    /* Ticket type */
    .order-ticket-type {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-family: var(--font-mono);
        font-size: 0.58rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--chalk-3);
        background: var(--ink-3);
        border: 1px solid var(--line);
        padding: 5px 10px;
        width: fit-content;
    }

    /* Qty */
    .order-qty {
        font-family: var(--font-mono);
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--chalk);
    }

    /* Amount */
    .order-amount {
        font-family: var(--font-mono);
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--chalk);
    }

    /* Status badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-family: var(--font-mono);
        font-size: 0.58rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        padding: 5px 12px;
        width: fit-content;
    }

    .status-badge::before {
        content: '';
        display: inline-block;
        width: 6px; height: 6px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .status-badge.completed {
        background: rgba(76,222,128,0.1);
        border: 1px solid rgba(76,222,128,0.3);
        color: var(--green-ok);
    }

    .status-badge.completed::before { background: var(--green-ok); }

    .status-badge.pending {
        background: rgba(245,166,35,0.1);
        border: 1px solid rgba(245,166,35,0.3);
        color: var(--amber);
    }

    .status-badge.pending::before { background: var(--amber); }

    .status-badge.cancelled, .status-badge.failed {
        background: rgba(255,63,63,0.1);
        border: 1px solid rgba(255,63,63,0.3);
        color: var(--red-hot);
    }

    .status-badge.cancelled::before,
    .status-badge.failed::before { background: var(--red-hot); }

    /* Date */
    .order-date {
        font-family: var(--font-mono);
        font-size: 0.68rem;
        color: var(--chalk-3);
        letter-spacing: 0.05em;
    }

    /* Actions */
    .order-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        text-decoration: none;
        padding: 8px 14px;
        border: 1px solid var(--line);
        color: var(--chalk-2);
        background: transparent;
        transition: all 0.18s;
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-action:hover {
        border-color: var(--chalk-3);
        color: var(--chalk) !important;
        background: var(--ink-3);
    }

    .btn-action.download {
        border-color: rgba(76,222,128,0.3);
        color: var(--green-ok);
    }

    .btn-action.download:hover {
        background: rgba(76,222,128,0.1);
        border-color: var(--green-ok);
        color: var(--green-ok) !important;
    }

    .btn-action i { font-size: 0.65rem; }

    /* ── PAGINATION ── */
    .orders-pagination {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 32px 0;
        border-top: 1px solid var(--line);
        flex-wrap: wrap;
        gap: 16px;
    }

    .orders-pagination .pagination {
        display: flex;
        gap: 4px;
        list-style: none;
        margin: 0; padding: 0;
    }

    .orders-pagination .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px; height: 36px;
        background: transparent;
        border: 1px solid var(--line);
        color: var(--chalk-3);
        font-family: var(--font-mono);
        font-size: 0.7rem;
        text-decoration: none;
        transition: all 0.18s;
        border-radius: 0;
    }

    .orders-pagination .page-item .page-link:hover {
        background: var(--ink-3);
        border-color: var(--chalk-3);
        color: var(--chalk);
    }

    .orders-pagination .page-item.active .page-link {
        background: var(--volt);
        border-color: var(--volt);
        color: var(--ink);
        font-weight: 700;
    }

    .orders-pagination .page-item.disabled .page-link {
        opacity: 0.3;
        pointer-events: none;
    }

    /* ── GENERIC BUTTON ── */
    .btn-view {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: var(--font-mono);
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--ink);
        text-decoration: none;
        padding: 14px 32px;
        background: var(--volt);
        border: none;
        transition: background 0.2s;
        cursor: pointer;
    }

    .btn-view:hover { background: #d4f545; color: var(--ink) !important; }

    /* ── ANIMATIONS ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .anim { opacity: 0; }
    .anim.visible { animation: fadeUp 0.5s cubic-bezier(0.2,0,0.3,1) forwards; }

    /* ── RESPONSIVE ── */
    @media (max-width: 1100px) {
        .orders-table-head,
        .order-row {
            grid-template-columns: 70px 1fr 120px 60px 100px 90px 90px 110px;
        }
    }

    @media (max-width: 900px) {
        .orders-table-head { display: none; }
        .order-row {
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto;
            gap: 12px 16px;
            padding: 20px;
        }
        .order-row > *:nth-child(2) { grid-column: span 2; }
        .orders-header-meta { display: none; }
    }

    @media (max-width: 600px) {
        .order-row { grid-template-columns: 1fr; }
        .order-row > * { grid-column: span 1; }
    }
</style>
@endpush

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="orders-header">
    <div class="container-fluid px-4 px-lg-5">
        <div class="orders-header-inner">
            <div>
                <div class="orders-header-eyebrow">Account</div>
                <h1>My <em>Orders.</em></h1>
            </div>
            @if($orders->isNotEmpty())
                <div class="orders-header-meta">
                    <div class="orders-count-num">{{ $orders->total() }}</div>
                    <div class="orders-count-label">Total Orders</div>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="container-fluid px-4 px-lg-5">

    {{-- ── ALERT ── --}}
    @if(session('success'))
        <div class="orders-alert anim">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
            <button class="orders-alert-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    {{-- ── EMPTY STATE ── --}}
    @if($orders->isEmpty())
        <div class="orders-empty anim">
            <i class="fas fa-shopping-bag orders-empty-icon"></i>
            <h3>No Orders Yet</h3>
            <p>You haven't placed any orders. Browse events and book your first ticket.</p>
            <a href="{{ route('events.index') }}" class="btn-view">
                Browse Events <i class="fas fa-arrow-right"></i>
            </a>
        </div>

    @else

        {{-- ── TABLE HEADER ── --}}
        <div class="orders-table-head anim">
            <span>Order</span>
            <span>Event</span>
            <span>Ticket</span>
            <span>Qty</span>
            <span>Amount</span>
            <span>Status</span>
            <span>Date</span>
            <span>Actions</span>
        </div>

        {{-- ── ROWS ── --}}
        @foreach($orders as $order)
            <div class="order-row anim" style="animation-delay: {{ $loop->index * 0.05 }}s">

                {{-- Order ID --}}
                <div class="order-id">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>

                {{-- Event name --}}
                <div class="order-event-name">{{ $order->ticket->event->name }}</div>

                {{-- Ticket type --}}
                <div>
                    <div class="order-ticket-type">
                        <i class="fas fa-ticket-alt"></i>
                        {{ $order->ticket->ticket_type }}
                    </div>
                </div>

                {{-- Quantity --}}
                <div class="order-qty">× {{ $order->quantity }}</div>

                {{-- Amount --}}
                <div class="order-amount">${{ number_format($order->payment->amount ?? 0, 2) }}</div>

                {{-- Status --}}
                <div>
                    <span class="status-badge {{ strtolower($order->status) }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                {{-- Date --}}
                <div class="order-date">{{ $order->created_at->format('M d, Y') }}</div>

                {{-- Actions --}}
                <div class="order-actions">
                    <a href="{{ route('orders.show', $order) }}" class="btn-action">
                        <i class="fas fa-eye"></i> View
                    </a>
                    @if($order->status === 'completed')
                        <a href="{{ route('orders.download', $order) }}" class="btn-action download">
                            <i class="fas fa-download"></i> Ticket
                        </a>
                    @endif
                </div>

            </div>
        @endforeach

        {{-- ── PAGINATION ── --}}
        <div class="orders-pagination anim">
            <span style="font-family: var(--font-mono); font-size: 0.62rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--chalk-3);">
                Page {{ $orders->currentPage() }} of {{ $orders->lastPage() }}
            </span>
            {{ $orders->links() }}
        </div>

    @endif

</div>

@endsection

@push('scripts')
<script>
    // Auto-dismiss alert
    setTimeout(() => {
        document.querySelectorAll('.orders-alert').forEach(el => {
            el.style.transition = 'opacity 0.4s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 400);
        });
    }, 4000);

    // Scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.04 });

    document.querySelectorAll('.anim').forEach(el => observer.observe(el));
</script>
@endpush