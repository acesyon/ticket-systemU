@extends('layouts.app')

@section('title', 'My Orders')

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
    .orders-header {
        padding: 60px 0 32px;
        background: linear-gradient(to bottom, var(--white), var(--off-white));
        border-bottom: 1px solid var(--border);
    }

    .orders-header-inner {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap;
    }

    .orders-header-eyebrow {
        display: inline-block;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--accent);
        background: var(--accent-soft);
        padding: 6px 14px;
        border-radius: 100px;
        margin-bottom: 20px;
    }

    .orders-header h1 {
        font-size: clamp(36px, 4vw, 48px);
        font-weight: 700;
        color: var(--text-primary);
        letter-spacing: -0.02em;
        line-height: 1.1;
    }

    .orders-header h1 em {
        font-style: normal;
        color: var(--accent);
    }

    .orders-header-meta {
        text-align: right;
        flex-shrink: 0;
    }

    .orders-count-num {
        font-size: 36px;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1.2;
    }

    .orders-count-label {
        font-size: 14px;
        color: var(--text-tertiary);
        font-weight: 400;
    }

    /* Alert */
    .orders-alert {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        border-radius: var(--radius-md);
        margin-bottom: 32px;
        background: var(--white);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
        border-left: 4px solid var(--success);
    }

    .orders-alert i {
        color: var(--success);
        font-size: 18px;
    }

    .orders-alert-content {
        flex: 1;
        color: var(--text-primary);
        font-size: 14px;
        font-weight: 500;
    }

    .orders-alert-close {
        background: none;
        border: none;
        color: var(--text-tertiary);
        cursor: pointer;
        font-size: 16px;
        padding: 4px;
        transition: color 0.2s;
    }

    .orders-alert-close:hover {
        color: var(--text-primary);
    }

    /* Empty State */
    .orders-empty {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 100px 40px;
        text-align: center;
        box-shadow: var(--shadow-sm);
        margin: 40px 0;
    }

    .orders-empty-icon {
        width: 80px;
        height: 80px;
        background: var(--off-white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        color: var(--text-tertiary);
        font-size: 32px;
    }

    .orders-empty h3 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 12px;
        color: var(--text-primary);
    }

    .orders-empty p {
        color: var(--text-secondary);
        margin-bottom: 32px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Table Header */
    .orders-table-head {
        display: grid;
        grid-template-columns: 80px 1.2fr 140px 70px 100px 100px 100px 130px;
        padding: 16px 24px;
        background: var(--off-white);
        border: 1px solid var(--border);
        border-top: none;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.03em;
        align-items: center;
    }

    /* Order Row */
    .order-row {
        display: grid;
        grid-template-columns: 80px 1.2fr 140px 70px 100px 100px 100px 130px;
        padding: 20px 24px;
        border: 1px solid var(--border);
        border-top: none;
        align-items: center;
        transition: background-color 0.2s;
        background: var(--white);
    }

    .order-row:hover {
        background-color: var(--off-white);
    }

    /* Order ID */
    .order-id {
        font-family: 'Inter', monospace;
        font-size: 13px;
        font-weight: 500;
        color: var(--text-tertiary);
        letter-spacing: 0.02em;
    }

    /* Event name */
    .order-event-name {
        font-weight: 600;
        font-size: 15px;
        color: var(--text-primary);
        line-height: 1.4;
        padding-right: 16px;
        word-break: break-word;
    }

    /* Ticket type */
    .order-ticket-type {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 500;
        color: var(--text-secondary);
        background: var(--off-white);
        border: 1px solid var(--border);
        padding: 6px 12px;
        border-radius: 100px;
        width: fit-content;
        white-space: nowrap;
    }

    .order-ticket-type i {
        color: var(--accent);
        font-size: 11px;
    }

    /* Quantity */
    .order-qty {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 14px;
        text-align: left;
    }

    /* Amount */
    .order-amount {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 15px;
        text-align: left;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 500;
        padding: 6px 14px;
        border-radius: 100px;
        width: fit-content;
        white-space: nowrap;
    }

    .status-badge::before {
        content: '';
        display: inline-block;
        width: 6px;
        height: 6px;
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

    /* Date */
    .order-date {
        font-size: 13px;
        color: var(--text-secondary);
        white-space: nowrap;
    }

    /* Actions */
    .order-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        padding: 8px 14px;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text-secondary);
        background: var(--white);
        transition: all 0.2s;
        cursor: pointer;
        white-space: nowrap;
        min-width: 70px;
    }

    .btn-action:hover {
        border-color: var(--accent);
        color: var(--accent);
        background: var(--accent-soft);
        transform: translateY(-1px);
    }

    .btn-action.download {
        border-color: var(--success-soft);
        color: var(--success);
        background: var(--white);
    }

    .btn-action.download:hover {
        border-color: var(--success);
        background: var(--success-soft);
        transform: translateY(-1px);
    }

    .btn-action i {
        font-size: 12px;
    }

    /* Pagination */
    .orders-pagination {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 32px 0 60px;
        border-top: 1px solid var(--border);
        flex-wrap: wrap;
        gap: 16px;
    }

    .orders-pagination-info {
        font-size: 14px;
        color: var(--text-tertiary);
    }

    .orders-pagination .pagination {
        display: flex;
        gap: 4px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .orders-pagination .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text-secondary);
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
    }

    .orders-pagination .page-item .page-link:hover {
        border-color: var(--accent);
        color: var(--accent);
        background: var(--accent-soft);
        transform: translateY(-1px);
    }

    .orders-pagination .page-item.active .page-link {
        background: var(--accent);
        border-color: var(--accent);
        color: white;
    }

    .orders-pagination .page-item.disabled .page-link {
        opacity: 0.5;
        pointer-events: none;
    }

    /* Generic Button */
    .btn-view {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 500;
        color: white;
        text-decoration: none;
        padding: 12px 28px;
        background: var(--accent);
        border: none;
        border-radius: var(--radius-sm);
        transition: all 0.2s;
        cursor: pointer;
    }

    .btn-view:hover {
        background: var(--accent-light);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-view i {
        transition: transform 0.2s;
    }

    .btn-view:hover i {
        transform: translateX(4px);
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
    @media (max-width: 1200px) {
        .orders-table-head,
        .order-row {
            grid-template-columns: 70px 1.1fr 130px 60px 90px 90px 90px 140px;
            padding: 16px 20px;
            gap: 8px;
        }
    }

    @media (max-width: 1024px) {
        .orders-table-head,
        .order-row {
            grid-template-columns: 60px 1fr 120px 50px 80px 80px 80px 140px;
            padding: 16px 16px;
            gap: 8px;
        }

        .order-event-name {
            font-size: 14px;
            padding-right: 8px;
        }

        .order-ticket-type {
            padding: 4px 8px;
            font-size: 11px;
        }

        .btn-action {
            padding: 6px 10px;
            min-width: 60px;
        }
    }

    @media (max-width: 900px) {
        .orders-table-head {
            display: none;
        }
        
        .order-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
            padding: 20px;
            border-radius: var(--radius-md);
            margin-bottom: 16px;
            border: 1px solid var(--border);
            background: var(--white);
        }
        
        .order-row > div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px dashed var(--border);
        }
        
        .order-row > div:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        
        .order-row .order-id::before {
            content: "Order ID:";
            color: var(--text-tertiary);
            font-size: 13px;
            font-weight: 400;
        }
        
        .order-row .order-event-name {
            font-weight: 600;
            font-size: 16px;
            padding-right: 0;
        }

        .order-row .order-event-name::before {
            content: "Event:";
            color: var(--text-tertiary);
            font-size: 13px;
            font-weight: 400;
            margin-right: 8px;
        }
        
        .order-row .order-ticket-type {
            margin-left: 0;
        }

        .order-row .order-ticket-type::before {
            content: "Ticket:";
            color: var(--text-tertiary);
            font-size: 13px;
            font-weight: 400;
            margin-right: 8px;
        }
        
        .order-row .order-qty::before {
            content: "Quantity:";
            color: var(--text-tertiary);
            font-size: 13px;
            font-weight: 400;
        }
        
        .order-row .order-amount::before {
            content: "Amount:";
            color: var(--text-tertiary);
            font-size: 13px;
            font-weight: 400;
        }

        .order-row .status-badge {
            margin-left: 0;
        }

        .order-row .status-badge::before {
            content: "Status:";
            color: var(--text-tertiary);
            font-size: 13px;
            font-weight: 400;
            background: none;
            width: auto;
            height: auto;
            border-radius: 0;
            margin-right: 8px;
        }

        .order-row .status-badge.completed::before,
        .order-row .status-badge.pending::before,
        .order-row .status-badge.cancelled::before {
            content: "Status:";
            background: none;
        }
        
        .order-row .order-date::before {
            content: "Date:";
            color: var(--text-tertiary);
            font-size: 13px;
            font-weight: 400;
        }
        
        .orders-header-meta {
            display: none;
        }
        
        .order-actions {
            justify-content: flex-end;
            gap: 12px;
        }

        .order-actions::before {
            content: "Actions:";
            color: var(--text-tertiary);
            font-size: 13px;
            font-weight: 400;
            margin-right: auto;
        }

        .btn-action {
            padding: 8px 16px;
            min-width: 80px;
        }
    }

    @media (max-width: 600px) {
        .container-custom {
            padding: 0 20px;
        }
        
        .orders-header {
            padding: 40px 0 24px;
        }

        .orders-header h1 {
            font-size: 32px;
        }

        .order-actions {
            flex-wrap: wrap;
            gap: 8px;
        }

        .order-actions::before {
            display: none;
        }

        .btn-action {
            flex: 1;
            min-width: calc(50% - 4px);
        }
    }

    @media (max-width: 400px) {
        .btn-action {
            min-width: 100%;
        }
    }
</style>
@endpush

@section('content')

{{-- Page Header --}}
<div class="orders-header">
    <div class="container-custom">
        <div class="orders-header-inner">
            <div>
                <span class="orders-header-eyebrow">Account</span>
                <h1>My <em class="text-gradient">Orders</em></h1>
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

<div class="container-custom">

    {{-- Alert --}}
    @if(session('success'))
        <div class="orders-alert anim">
            <i class="bi bi-check-circle-fill"></i>
            <span class="orders-alert-content">{{ session('success') }}</span>
            <button class="orders-alert-close" onclick="this.parentElement.remove()">
                <i class="bi bi-x"></i>
            </button>
        </div>
    @endif

    {{-- Empty State --}}
    @if($orders->isEmpty())
        <div class="orders-empty anim">
            <div class="orders-empty-icon">
                <i class="bi bi-bag"></i>
            </div>
            <h3>No Orders Yet</h3>
            <p>You haven't placed any orders. Browse events and book your first ticket.</p>
            <a href="{{ route('events.index') }}" class="btn-view">
                Browse Events <i class="bi bi-arrow-right"></i>
            </a>
        </div>

    @else

        {{-- Table Header --}}
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

        {{-- Rows --}}
        @foreach($orders as $order)
            <div class="order-row anim" style="animation-delay: {{ $loop->index * 0.05 }}s">

                {{-- Order ID --}}
                <div class="order-id">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>

                {{-- Event name --}}
                <div class="order-event-name">{{ $order->ticket->event->name ?? 'Event' }}</div>

                {{-- Ticket type --}}
                <div>
                    <span class="order-ticket-type">
                        <i class="bi bi-ticket-perforated"></i>
                        {{ $order->ticket->ticket_type ?? 'Standard' }}
                    </span>
                </div>

                {{-- Quantity --}}
                <div class="order-qty">{{ $order->quantity }}</div>

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
                        <i class="bi bi-eye"></i> View
                    </a>
                    @if($order->status === 'completed')
                        <a href="{{ route('orders.download', $order) }}" class="btn-action download">
                            <i class="bi bi-download"></i> Ticket
                        </a>
                    @endif
                </div>

            </div>
        @endforeach

        {{-- Pagination --}}
        <div class="orders-pagination anim">
            <span class="orders-pagination-info">
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
</script>
@endpush