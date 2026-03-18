@extends('layouts.app')

@section('title', 'Shopping Cart')

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
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Page Header */
    .cart-header {
        padding: 60px 0 32px;
        background: linear-gradient(to bottom, var(--white), var(--off-white));
        border-bottom: 1px solid var(--border);
    }

    .cart-header-eyebrow {
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

    .cart-header h1 {
        font-size: clamp(36px, 4vw, 48px);
        font-weight: 700;
        color: var(--text-primary);
        letter-spacing: -0.02em;
        line-height: 1.1;
    }

    .cart-header h1 em {
        font-style: normal;
        color: var(--accent);
    }

    /* Alerts */
    .cart-alert {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        border-radius: var(--radius-md);
        margin-bottom: 32px;
        background: var(--white);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
    }

    .cart-alert.success {
        border-left: 4px solid var(--success);
    }

    .cart-alert.error {
        border-left: 4px solid var(--error);
    }

    .cart-alert i {
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .cart-alert.success i {
        color: var(--success);
    }

    .cart-alert.error i {
        color: var(--error);
    }

    .cart-alert-content {
        flex: 1;
        color: var(--text-primary);
        font-size: 14px;
        font-weight: 500;
    }

    .cart-alert-close {
        background: none;
        border: none;
        color: var(--text-tertiary);
        cursor: pointer;
        font-size: 16px;
        padding: 4px;
        transition: color 0.2s;
    }

    .cart-alert-close:hover {
        color: var(--text-primary);
    }

    /* Empty State */
    .cart-empty {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 100px 40px;
        text-align: center;
        box-shadow: var(--shadow-sm);
        margin: 40px 0;
    }

    .cart-empty-icon {
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

    .cart-empty h3 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 12px;
        color: var(--text-primary);
    }

    .cart-empty p {
        color: var(--text-secondary);
        margin-bottom: 32px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Cart Layout */
    .cart-layout {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 32px;
        align-items: start;
        margin: 32px 0 60px;
    }

    /* Cart Items Panel */
    .cart-items-panel {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    /* Table Header */
    .cart-table-head {
        display: grid;
        grid-template-columns: 2.5fr 1fr 1.2fr 1fr 44px;
        padding: 16px 24px;
        background: var(--off-white);
        border-bottom: 1px solid var(--border);
        font-size: 13px;
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    /* Cart Row */
    .cart-row {
        display: grid;
        grid-template-columns: 2.5fr 1fr 1.2fr 1fr 44px;
        padding: 24px;
        border-bottom: 1px solid var(--border);
        transition: background-color 0.2s;
        align-items: center;
    }

    .cart-row:last-child {
        border-bottom: none;
    }

    .cart-row:hover {
        background-color: var(--off-white);
    }

    /* Event Info */
    .cart-event-name {
        font-weight: 600;
        font-size: 16px;
        color: var(--text-primary);
        text-decoration: none;
        margin-bottom: 8px;
        display: inline-block;
    }

    .cart-event-name:hover {
        color: var(--accent);
    }

    .cart-ticket-type {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        background: var(--off-white);
        border: 1px solid var(--border);
        border-radius: 100px;
        font-size: 12px;
        color: var(--text-secondary);
        width: fit-content;
    }

    .cart-ticket-type i {
        color: var(--accent);
        font-size: 11px;
    }

    /* Price Cell */
    .cart-price {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 15px;
    }

    /* Quantity Controls */
    .qty-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .qty-input {
        width: 65px;
        height: 38px;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        text-align: center;
        font-weight: 500;
        font-size: 14px;
        color: var(--text-primary);
        background: var(--white);
        -moz-appearance: textfield;
    }

    .qty-input::-webkit-outer-spin-button,
    .qty-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .qty-input:focus {
        outline: none;
        border-color: var(--accent);
    }

    .btn-qty-update {
        width: 38px;
        height: 38px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text-secondary);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .btn-qty-update:hover {
        border-color: var(--accent);
        color: var(--accent);
        background: var(--accent-soft);
    }

    /* Subtotal Cell */
    .cart-subtotal {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 15px;
    }

    /* Remove Button */
    .btn-remove {
        width: 36px;
        height: 36px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text-tertiary);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .btn-remove:hover {
        border-color: var(--error);
        color: var(--error);
        background: #fef2f2;
    }

    /* Cart Summary */
    .cart-summary {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 28px;
        position: sticky;
        top: 100px;
        box-shadow: var(--shadow-sm);
    }

    .summary-label {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: var(--text-secondary);
        margin-bottom: 20px;
        display: block;
    }

    /* Summary Items List */
    .summary-items {
        margin-bottom: 16px;
        max-height: 300px;
        overflow-y: auto;
        padding-right: 8px;
    }

    .summary-items::-webkit-scrollbar {
        width: 4px;
    }

    .summary-items::-webkit-scrollbar-track {
        background: var(--off-white);
        border-radius: 4px;
    }

    .summary-items::-webkit-scrollbar-thumb {
        background: var(--text-tertiary);
        border-radius: 4px;
    }

    .summary-line {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px dashed var(--border);
        font-size: 14px;
    }

    .summary-line:first-child {
        padding-top: 0;
    }

    .summary-line-label {
        color: var(--text-secondary);
        max-width: 70%;
        font-weight: 500;
    }

    .summary-line-label span {
        color: var(--text-tertiary);
        font-size: 12px;
        font-weight: 400;
        margin-left: 4px;
    }

    .summary-line-val {
        font-weight: 600;
        color: var(--text-primary);
    }

    /* Summary Total */
    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px 0 24px;
        padding-top: 20px;
        border-top: 2px solid var(--border);
    }

    .summary-total-label {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
    }

    .summary-total-val {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-primary);
    }

    /* Checkout Button */
    .btn-checkout {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 16px 24px;
        background: var(--accent);
        color: white;
        border: none;
        border-radius: var(--radius-sm);
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        margin-bottom: 12px;
    }

    .btn-checkout:hover {
        background: var(--accent-light);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-checkout i {
        transition: transform 0.2s;
    }

    .btn-checkout:hover i {
        transform: translateX(4px);
    }

    /* Continue Shopping Button */
    .btn-continue {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 14px 24px;
        background: var(--white);
        color: var(--text-secondary);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        font-weight: 500;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-continue:hover {
        border-color: var(--accent);
        color: var(--accent);
        background: var(--off-white);
    }

    .btn-continue i {
        transition: transform 0.2s;
    }

    .btn-continue:hover i {
        transform: translateX(-4px);
    }

    /* Security Note */
    .summary-note {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid var(--border);
        color: var(--text-tertiary);
        font-size: 12px;
        line-height: 1.5;
    }

    .summary-note i {
        font-size: 14px;
        color: var(--success);
        flex-shrink: 0;
        margin-top: 2px;
    }

    /* Animation */
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
        .cart-layout {
            grid-template-columns: 1fr;
        }

        .cart-summary {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .container-custom {
            padding: 0 20px;
        }

        .cart-header {
            padding: 40px 0 24px;
        }

        .cart-table-head {
            display: none;
        }

        .cart-row {
            grid-template-columns: 1fr;
            gap: 16px;
            padding: 20px;
        }

        .cart-row > div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px dashed var(--border);
        }

        .cart-row > div:last-child {
            border-bottom: none;
            justify-content: flex-end;
        }

        .cart-price::before {
            content: "Price:";
            color: var(--text-tertiary);
            font-size: 14px;
            font-weight: 400;
        }

        .cart-subtotal::before {
            content: "Subtotal:";
            color: var(--text-tertiary);
            font-size: 14px;
            font-weight: 400;
        }

        .qty-wrap {
            width: 100%;
            justify-content: flex-end;
        }
    }
</style>
@endpush

@section('content')
{{-- Page Header --}}
<div class="cart-header">
    <div class="container-custom">
        <span class="cart-header-eyebrow">Your Order</span>
        <h1>Shopping <em class="text-gradient">Cart</em></h1>
    </div>
</div>

<div class="container-custom">
    {{-- Alerts --}}
    @if(session('success'))
        <div class="cart-alert success anim" id="alertSuccess">
            <i class="bi bi-check-circle-fill"></i>
            <span class="cart-alert-content">{{ session('success') }}</span>
            <button class="cart-alert-close" onclick="this.parentElement.remove()">
                <i class="bi bi-x"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="cart-alert error anim" id="alertError">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span class="cart-alert-content">{{ session('error') }}</span>
            <button class="cart-alert-close" onclick="this.parentElement.remove()">
                <i class="bi bi-x"></i>
            </button>
        </div>
    @endif

    {{-- Empty State --}}
    @if(empty($cart))
        <div class="cart-empty anim">
            <div class="cart-empty-icon">
                <i class="bi bi-bag"></i>
            </div>
            <h3>Your cart is empty</h3>
            <p>Looks like you haven't added any tickets yet. Browse our events and find something you'll love.</p>
            <a href="{{ route('events.index') }}" class="btn-checkout" style="display: inline-flex; width: auto; padding: 14px 32px;">
                Browse Events <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    @else
        {{-- Cart Layout --}}
        <div class="cart-layout">
            {{-- Left: Cart Items --}}
            <div class="cart-items-panel">
                {{-- Table Header --}}
                <div class="cart-table-head">
                    <span>Event & Ticket</span>
                    <span>Price</span>
                    <span>Quantity</span>
                    <span>Subtotal</span>
                    <span></span>
                </div>

                {{-- Cart Rows --}}
                @foreach($cart as $id => $item)
                    <div class="cart-row anim" style="animation-delay: {{ $loop->index * 0.05 }}s">
                        {{-- Event Info --}}
                        <div>
                            {{-- Check if event_id exists before using it --}}
                            @if(isset($item['event_id']) || isset($item['event']))
                                <a href="{{ route('events.show', $item['event_id'] ?? $item['event']['id'] ?? $id) }}" class="cart-event-name">
                                    {{ $item['event_name'] ?? $item['event']['name'] ?? 'Event' }}
                                </a>
                            @else
                                <span class="cart-event-name">
                                    {{ $item['event_name'] ?? $item['event']['name'] ?? 'Event' }}
                                </span>
                            @endif
                            
                            <span class="cart-ticket-type">
                                <i class="bi bi-ticket-perforated"></i>
                                {{ $item['ticket_type'] ?? $item['ticket']['type'] ?? 'Standard' }}
                            </span>
                        </div>

                        {{-- Price --}}
                        <div class="cart-price">
                            ${{ number_format($item['price'] ?? $item['ticket']['price'] ?? 0, 2) }}
                        </div>

                        {{-- Quantity --}}
                        <div>
                            <form action="{{ route('cart.update', $item['ticket_id'] ?? $item['ticket']['id'] ?? $id) }}"
                                  method="POST"
                                  class="update-cart-form qty-wrap">
                                @csrf
                                @method('PATCH')
                                <input type="number"
                                       name="quantity"
                                       class="qty-input"
                                       value="{{ $item['quantity'] ?? 1 }}"
                                       min="1"
                                       max="{{ $item['max_available'] ?? 10 }}">
                                <button type="submit" class="btn-qty-update" title="Update quantity">
                                    <i class="bi bi-arrow-repeat"></i>
                                </button>
                            </form>
                        </div>

                        {{-- Subtotal --}}
                        <div class="cart-subtotal">
                            ${{ number_format(($item['price'] ?? $item['ticket']['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }}
                        </div>

                        {{-- Remove --}}
                        <div>
                            <form action="{{ route('cart.remove', $item['ticket_id'] ?? $item['ticket']['id'] ?? $id) }}"
                                  method="POST"
                                  class="remove-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-remove" title="Remove item">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Right: Cart Summary --}}
            <div class="cart-summary anim" style="animation-delay: 0.1s">
                <span class="summary-label">Order Summary</span>

                {{-- Summary Items --}}
                <div class="summary-items">
                    @foreach($cart as $item)
                        <div class="summary-line">
                            <span class="summary-line-label">
                                {{ \Illuminate\Support\Str::limit($item['event_name'] ?? $item['event']['name'] ?? 'Event', 30) }}
                                <span>×{{ $item['quantity'] ?? 1 }}</span>
                            </span>
                            <span class="summary-line-val">
                                ${{ number_format(($item['price'] ?? $item['ticket']['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }}
                            </span>
                        </div>
                    @endforeach
                </div>

                {{-- Total --}}
                <div class="summary-total">
                    <span class="summary-total-label">Total</span>
                    <span class="summary-total-val">${{ number_format($total ?? 0, 2) }}</span>
                </div>

                {{-- CTA Buttons --}}
                <a href="{{ route('cart.checkout') }}" class="btn-checkout">
                    Proceed to Checkout <i class="bi bi-arrow-right"></i>
                </a>

                <a href="{{ route('events.index') }}" class="btn-continue">
                    <i class="bi bi-arrow-left"></i> Continue Shopping
                </a>

                {{-- Security Note --}}
                <div class="summary-note">
                    <i class="bi bi-shield-check"></i>
                    <p>Your payment information is encrypted and secure. We never store your credit card details.</p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Quantity validation
    document.querySelectorAll('.update-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const input = this.querySelector('input[name="quantity"]');
            const qty = parseInt(input.value);
            const min = parseInt(input.min);
            const max = parseInt(input.max);
            
            if (isNaN(qty) || qty < min || qty > max) {
                e.preventDefault();
                input.style.borderColor = 'var(--error)';
                input.focus();
                setTimeout(() => input.style.borderColor = 'var(--border)', 2000);
            }
        });
    });

    // Remove confirmation
    document.querySelectorAll('.remove-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Remove this item from your cart?')) {
                e.preventDefault();
            }
        });
    });

    // Auto-dismiss alerts
    setTimeout(() => {
        document.querySelectorAll('.cart-alert').forEach(alert => {
            alert.style.transition = 'opacity 0.4s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 400);
        });
    }, 5000);

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