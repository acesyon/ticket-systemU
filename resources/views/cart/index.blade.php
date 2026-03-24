@extends('layouts.app')

@section('title', 'Shopping Cart')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,600;0,9..144,700;1,9..144,300&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* ═══════════════════════════════════════════════════════════════════════════
   TOKENS — matching home page design system
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
.cart-header {
    background: var(--ink);
    padding: 64px 0 56px;
    position: relative;
    overflow: hidden;
}

.cart-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
    background-size: 32px 32px;
    pointer-events: none;
}

.cart-header::after {
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

.cart-header h1 {
    font-family: var(--f-display);
    font-size: clamp(48px, 6vw, 72px);
    font-weight: 600;
    line-height: 1.0;
    letter-spacing: -0.03em;
    color: var(--white);
}

.cart-header h1 em {
    font-style: italic;
    font-weight: 300;
    color: var(--gold);
}

/* ═══════════════════════════════════════════════════════════════════════════
   ALERTS
═══════════════════════════════════════════════════════════════════════════ */
.cart-alert {
    display: flex;
    align-items: center;
    gap: 12px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-md);
    padding: 16px 24px;
    margin: 32px 0 24px;
    box-shadow: var(--shadow-card);
    position: relative;
}

.cart-alert.success { border-left: 3px solid var(--success); }
.cart-alert.error   { border-left: 3px solid var(--error); }

.cart-alert i {
    font-size: 20px;
}

.cart-alert.success i { color: var(--success); }
.cart-alert.error i   { color: var(--error); }

.cart-alert-content {
    flex: 1;
    font-size: 14px;
    font-weight: 500;
    color: var(--ink);
}

.cart-alert-close {
    background: none;
    border: none;
    font-size: 18px;
    color: var(--text-muted);
    cursor: pointer;
    padding: 4px;
    transition: color 0.2s;
}

.cart-alert-close:hover { color: var(--ink); }

/* ═══════════════════════════════════════════════════════════════════════════
   EMPTY STATE
═══════════════════════════════════════════════════════════════════════════ */
.empty-cart {
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

.empty-cart h3 {
    font-family: var(--f-display);
    font-size: 28px;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 12px;
}

.empty-cart p {
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
    transform: translateY(-1px);
    box-shadow: 0 8px 24px rgba(201,168,76,0.25);
}

/* ═══════════════════════════════════════════════════════════════════════════
   CART LAYOUT
═══════════════════════════════════════════════════════════════════════════ */
.cart-grid {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 40px;
    margin: 40px 0 80px;
    align-items: start;
}

/* ──────────────────────────────────────────────────────────────────────────
   Cart Items Panel
────────────────────────────────────────────────────────────────────────── */
.cart-panel {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    box-shadow: var(--shadow-card);
}

/* Table header */
.cart-header-row {
    display: grid;
    grid-template-columns: 2.5fr 1fr 1.2fr 1fr 48px;
    padding: 18px 28px;
    background: var(--mist-2);
    border-bottom: 1px solid var(--border);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
}

/* Cart item row */
.cart-item {
    display: grid;
    grid-template-columns: 2.5fr 1fr 1.2fr 1fr 48px;
    padding: 28px;
    border-bottom: 1px solid var(--border);
    transition: background 0.2s;
    align-items: center;
}

.cart-item:last-child { border-bottom: none; }
.cart-item:hover { background: var(--mist); }

/* Event info */
.item-event-name {
    font-family: var(--f-display);
    font-size: 18px;
    font-weight: 600;
    color: var(--ink);
    text-decoration: none;
    display: inline-block;
    margin-bottom: 8px;
    letter-spacing: -0.02em;
}

.item-event-name:hover {
    color: var(--gold);
}

.item-ticket-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--gold-soft);
    padding: 5px 12px;
    border-radius: 100px;
    font-size: 11px;
    font-weight: 600;
    color: #8a6a1a;
    letter-spacing: 0.02em;
}

.item-ticket-badge i {
    font-size: 10px;
}

/* Price */
.item-price {
    font-weight: 600;
    color: var(--ink);
    font-size: 15px;
}

/* Quantity controls */
.qty-control {
    display: flex;
    align-items: center;
    gap: 8px;
}

.qty-input {
    width: 70px;
    height: 42px;
    border: 1px solid var(--border);
    border-radius: var(--r-sm);
    text-align: center;
    font-family: var(--f-body);
    font-weight: 500;
    font-size: 14px;
    background: var(--white);
    color: var(--ink);
    -moz-appearance: textfield;
}

.qty-input::-webkit-outer-spin-button,
.qty-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.qty-input:focus {
    outline: none;
    border-color: var(--gold);
}

.btn-qty {
    width: 42px;
    height: 42px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-sm);
    color: var(--text-muted);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.btn-qty:hover {
    border-color: var(--gold);
    color: var(--gold);
    background: var(--gold-soft);
}

/* Subtotal */
.item-subtotal {
    font-weight: 700;
    color: var(--ink);
    font-size: 16px;
}

/* Remove button */
.btn-remove {
    width: 42px;
    height: 42px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-sm);
    color: var(--text-muted);
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

/* ──────────────────────────────────────────────────────────────────────────
   Cart Summary
────────────────────────────────────────────────────────────────────────── */
.cart-summary {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    padding: 32px;
    position: sticky;
    top: 100px;
    box-shadow: var(--shadow-card);
}

.summary-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gold);
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 24px;
}

.summary-label::before {
    content: '';
    width: 24px;
    height: 1px;
    background: var(--gold);
}

/* Summary items list */
.summary-items {
    margin-bottom: 24px;
    max-height: 320px;
    overflow-y: auto;
    padding-right: 8px;
}

.summary-items::-webkit-scrollbar {
    width: 4px;
}

.summary-items::-webkit-scrollbar-track {
    background: var(--mist-2);
    border-radius: 4px;
}

.summary-items::-webkit-scrollbar-thumb {
    background: var(--text-muted);
    border-radius: 4px;
}

.summary-item-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px dashed var(--border);
    font-size: 14px;
}

.summary-item-name {
    color: var(--text-body);
    max-width: 70%;
}

.summary-item-name span {
    color: var(--text-muted);
    font-size: 12px;
    margin-left: 4px;
}

.summary-item-price {
    font-weight: 600;
    color: var(--ink);
}

/* Total */
.summary-total {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    padding: 20px 0 24px;
    border-top: 2px solid var(--border);
    margin-top: 8px;
}

.total-label {
    font-family: var(--f-display);
    font-size: 20px;
    font-weight: 600;
    color: var(--ink);
}

.total-value {
    font-family: var(--f-display);
    font-size: 28px;
    font-weight: 700;
    color: var(--gold);
}

/* Buttons */
.btn-checkout {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    background: var(--gold);
    color: var(--ink);
    font-weight: 600;
    font-size: 15px;
    padding: 16px 24px;
    border-radius: var(--r-md);
    text-decoration: none;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
    margin-bottom: 12px;
}

.btn-checkout:hover {
    background: var(--gold-light);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(201,168,76,0.25);
}

.btn-checkout i {
    transition: transform 0.2s;
}

.btn-checkout:hover i {
    transform: translateX(4px);
}

.btn-continue {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    background: transparent;
    color: var(--text-muted);
    font-weight: 500;
    font-size: 14px;
    padding: 14px 24px;
    border-radius: var(--r-md);
    text-decoration: none;
    border: 1px solid var(--border);
    transition: all 0.2s;
}

.btn-continue:hover {
    border-color: var(--gold);
    color: var(--gold);
    background: var(--gold-soft);
}

.btn-continue i {
    transition: transform 0.2s;
}

.btn-continue:hover i {
    transform: translateX(-4px);
}

/* Security note */
.summary-note {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid var(--border);
    font-size: 12px;
    color: var(--text-muted);
    line-height: 1.5;
}

.summary-note i {
    color: var(--success);
    font-size: 14px;
    flex-shrink: 0;
    margin-top: 2px;
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
    .cart-grid {
        grid-template-columns: 1fr;
        gap: 32px;
    }
    
    .cart-summary {
        position: static;
    }
}

@media (max-width: 768px) {
    .wrap {
        padding: 0 20px;
    }
    
    .cart-header {
        padding: 48px 0 40px;
    }
    
    .cart-header-row {
        display: none;
    }
    
    .cart-item {
        grid-template-columns: 1fr;
        gap: 16px;
        padding: 24px;
    }
    
    .cart-item > div {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px dashed var(--border);
    }
    
    .cart-item > div:last-child {
        border-bottom: none;
        justify-content: flex-end;
    }
    
    .item-price::before {
        content: "Price:";
        color: var(--text-muted);
        font-size: 13px;
        font-weight: 500;
        margin-right: 12px;
    }
    
    .item-subtotal::before {
        content: "Subtotal:";
        color: var(--text-muted);
        font-size: 13px;
        font-weight: 500;
        margin-right: 12px;
    }
    
    .qty-control {
        width: 100%;
        justify-content: flex-end;
    }
    
    .qty-control::before {
        content: "Quantity:";
        color: var(--text-muted);
        font-size: 13px;
        font-weight: 500;
        margin-right: 12px;
    }
    
    .cart-summary {
        padding: 24px;
    }
}
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════════════════════════════════════
     HERO SECTION — matches home page aesthetic
═══════════════════════════════════════════════════════════════════════════ --}}
<div class="cart-header">
    <div class="wrap">
        <div class="header-eyebrow">Secure Checkout</div>
        <h1>Shopping <em>Cart</em></h1>
    </div>
</div>

<div class="wrap">

    {{-- ══ ALERTS ═══════════════════════════════════════════════════════════ --}}
    @if(session('success'))
        <div class="cart-alert success anim-fade" id="alertSuccess">
            <i class="bi bi-check-circle-fill"></i>
            <span class="cart-alert-content">{{ session('success') }}</span>
            <button class="cart-alert-close" onclick="this.parentElement.remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="cart-alert error anim-fade" id="alertError">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span class="cart-alert-content">{{ session('error') }}</span>
            <button class="cart-alert-close" onclick="this.parentElement.remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    {{-- ══ EMPTY STATE ═══════════════════════════════════════════════════════ --}}
    @if(empty($cart) || count($cart) === 0)
        <div class="empty-cart anim-fade">
            <div class="empty-icon">
                <i class="bi bi-bag"></i>
            </div>
            <h3>Your cart is empty</h3>
            <p>Looks like you haven't added any tickets yet. Discover amazing events and secure your spot.</p>
            <a href="{{ route('events.index') }}" class="btn-gold">
                Browse Events <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    @else
        {{-- ══ CART GRID ═══════════════════════════════════════════════════════ --}}
        <div class="cart-grid">

            {{-- LEFT: CART ITEMS PANEL --}}
            <div class="cart-panel">
                <div class="cart-header-row">
                    <span>Event & Ticket</span>
                    <span>Price</span>
                    <span>Quantity</span>
                    <span>Subtotal</span>
                    <span></span>
                </div>

                @foreach($cart as $id => $item)
                    @php
                        $eventId   = $item['event_id'] ?? $item['event']['id'] ?? $id;
                        $eventName = $item['event_name'] ?? $item['event']['name'] ?? 'Event';
                        $ticketType = $item['ticket_type'] ?? $item['ticket']['type'] ?? 'Standard';
                        $price     = $item['price'] ?? $item['ticket']['price'] ?? 0;
                        $quantity  = $item['quantity'] ?? 1;
                        $subtotal  = $price * $quantity;
                        $maxQty    = $item['max_available'] ?? 10;
                        $ticketId  = $item['ticket_id'] ?? $item['ticket']['id'] ?? $id;
                    @endphp

                    <div class="cart-item anim-fade" data-cart-id="{{ $id }}" style="animation-delay: {{ $loop->index * 0.05 }}s">
                        
                        {{-- Event info --}}
                        <div>
                            <a href="{{ route('events.show', $eventId) }}" class="item-event-name">
                                {{ Str::limit($eventName, 60) }}
                            </a>
                            <div class="item-ticket-badge">
                                <i class="bi bi-ticket-perforated"></i>
                                {{ $ticketType }}
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="item-price">
                            ${{ number_format($price, 2) }}
                        </div>

                        {{-- Quantity control --}}
                        <div>
                            <form action="{{ route('cart.update', $ticketId) }}" method="POST" class="update-cart-form">
                                @csrf
                                @method('PATCH')
                                <div class="qty-control">
                                    <input type="number"
                                           name="quantity"
                                           class="qty-input"
                                           value="{{ $quantity }}"
                                           min="1"
                                           max="{{ $maxQty }}">
                                    <button type="submit" class="btn-qty" title="Update quantity">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- Subtotal --}}
                        <div class="item-subtotal">
                            ${{ number_format($subtotal, 2) }}
                        </div>

                        {{-- Remove button --}}
                        <div>
                            <form action="{{ route('cart.remove', $ticketId) }}" method="POST" class="remove-form">
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

            {{-- RIGHT: CART SUMMARY --}}
            <div class="cart-summary anim-fade" style="animation-delay: 0.1s">
                <div class="summary-label">Order Summary</div>

                <div class="summary-items">
                    @foreach($cart as $item)
                        @php
                            $eventName = $item['event_name'] ?? $item['event']['name'] ?? 'Event';
                            $qty = $item['quantity'] ?? 1;
                            $price = $item['price'] ?? $item['ticket']['price'] ?? 0;
                        @endphp
                        <div class="summary-item-row">
                            <span class="summary-item-name">
                                {{ Str::limit($eventName, 32) }}
                                <span>×{{ $qty }}</span>
                            </span>
                            <span class="summary-item-price">
                                ${{ number_format($price * $qty, 2) }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="summary-total">
                    <span class="total-label">Total</span>
                    <span class="total-value">${{ number_format($total ?? 0, 2) }}</span>
                </div>

                <a href="{{ route('cart.checkout') }}" class="btn-checkout">
                    Proceed to Checkout <i class="bi bi-arrow-right"></i>
                </a>

                <a href="{{ route('events.index') }}" class="btn-continue">
                    <i class="bi bi-arrow-left"></i> Continue Shopping
                </a>

                <div class="summary-note">
                    <i class="bi bi-shield-check"></i>
                    <p>Your payment details are encrypted and secure. We never store sensitive information.</p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
(function() {
    // ──────────────────────────────────────────────────────────────────────────
    // Quantity validation
    // ──────────────────────────────────────────────────────────────────────────
    document.querySelectorAll('.update-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const input = this.querySelector('input[name="quantity"]');
            if (!input) return;
            
            const qty = parseInt(input.value);
            const min = parseInt(input.min) || 1;
            const max = parseInt(input.max) || 999;
            
            if (isNaN(qty) || qty < min || qty > max) {
                e.preventDefault();
                input.style.borderColor = '#c0392b';
                input.style.outline = 'none';
                input.focus();
                setTimeout(() => {
                    input.style.borderColor = 'var(--border)';
                }, 2000);
            }
        });
    });

    // ──────────────────────────────────────────────────────────────────────────
    // Remove confirmation
    // ──────────────────────────────────────────────────────────────────────────
    document.querySelectorAll('.remove-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Remove this item from your cart?')) {
                e.preventDefault();
            }
        });
    });

    // ──────────────────────────────────────────────────────────────────────────
    // Auto-dismiss alerts after 5 seconds
    // ──────────────────────────────────────────────────────────────────────────
    setTimeout(() => {
        document.querySelectorAll('.cart-alert').forEach(alert => {
            alert.style.transition = 'opacity 0.4s ease';
            alert.style.opacity = '0';
            setTimeout(() => {
                if (alert.parentNode) alert.remove();
            }, 400);
        });
    }, 5000);

    // ──────────────────────────────────────────────────────────────────────────
    // Intersection Observer for scroll animations
    // ──────────────────────────────────────────────────────────────────────────
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