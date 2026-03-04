@extends('layouts.app')

@section('title', 'Shopping Cart')

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
    .cart-header {
        background: var(--ink-2);
        border-bottom: 1px solid var(--line);
        padding: 56px 0 40px;
        margin-top: -24px;
    }

    .cart-header-eyebrow {
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

    .cart-header-eyebrow::before {
        content: '';
        display: inline-block;
        width: 28px; height: 2px;
        background: var(--volt);
    }

    .cart-header h1 {
        font-family: var(--font-display);
        font-size: clamp(2.4rem, 4vw, 3.8rem);
        font-weight: 900;
        color: var(--chalk);
        letter-spacing: -0.02em;
        line-height: 1.0;
    }

    .cart-header h1 em {
        font-style: italic;
        color: var(--volt);
    }

    /* ── ALERTS ── */
    .cart-alert {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 20px;
        border: 1px solid var(--line);
        font-size: 0.9rem;
        font-family: var(--font-body);
        margin-bottom: 0;
        border-radius: 0;
    }

    .cart-alert.success {
        background: rgba(76, 222, 128, 0.06);
        border-color: rgba(76, 222, 128, 0.3);
        color: var(--green-ok);
    }

    .cart-alert.error {
        background: rgba(255, 63, 63, 0.06);
        border-color: rgba(255, 63, 63, 0.3);
        color: var(--red-hot);
    }

    .cart-alert i { font-size: 0.85rem; flex-shrink: 0; }

    .cart-alert-close {
        margin-left: auto;
        background: none;
        border: none;
        color: inherit;
        cursor: pointer;
        opacity: 0.6;
        font-size: 0.8rem;
        transition: opacity 0.2s;
        padding: 0;
    }

    .cart-alert-close:hover { opacity: 1; }

    /* ── EMPTY STATE ── */
    .cart-empty {
        padding: 100px 40px;
        text-align: center;
        border: 1px solid var(--line);
        border-top: none;
    }

    .cart-empty-icon {
        font-size: 3rem;
        color: var(--chalk-3);
        margin-bottom: 24px;
        display: block;
    }

    .cart-empty h3 {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 900;
        color: var(--chalk);
        margin-bottom: 10px;
    }

    .cart-empty p {
        color: var(--chalk-3);
        font-size: 0.95rem;
        margin-bottom: 32px;
    }

    /* ── LAYOUT ── */
    .cart-layout {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 1px;
        background: var(--line);
        border: 1px solid var(--line);
        border-top: none;
        align-items: start;
    }

    /* ── CART ITEMS PANEL ── */
    .cart-items-panel { background: var(--ink); }

    /* Table header */
    .cart-table-head {
        display: grid;
        grid-template-columns: 1fr 140px 100px 90px 44px;
        gap: 0;
        padding: 14px 28px;
        background: var(--ink-2);
        border-bottom: 1px solid var(--line);
    }

    .cart-table-head span {
        font-family: var(--font-mono);
        font-size: 0.58rem;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--chalk-3);
    }

    /* Cart row */
    .cart-row {
        display: grid;
        grid-template-columns: 1fr 140px 100px 90px 44px;
        gap: 0;
        padding: 24px 28px;
        border-bottom: 1px solid var(--line);
        align-items: center;
        transition: background 0.18s;
    }

    .cart-row:last-child { border-bottom: none; }
    .cart-row:hover { background: var(--ink-2); }

    /* Event info cell */
    .cart-event-name {
        font-family: var(--font-display);
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--chalk);
        line-height: 1.2;
        margin-bottom: 5px;
        letter-spacing: -0.01em;
    }

    .cart-ticket-type {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--chalk-3);
        background: var(--ink-3);
        border: 1px solid var(--line);
        padding: 4px 10px;
    }

    /* Price cell */
    .cart-price {
        font-family: var(--font-mono);
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--chalk);
    }

    /* Quantity cell */
    .qty-wrap {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .qty-input {
        width: 52px;
        background: var(--ink-3);
        border: 1px solid var(--line);
        color: var(--chalk);
        font-family: var(--font-mono);
        font-size: 0.85rem;
        font-weight: 700;
        text-align: center;
        padding: 8px 4px;
        outline: none;
        transition: border-color 0.2s;
        border-radius: 0;
        -moz-appearance: textfield;
    }

    .qty-input::-webkit-outer-spin-button,
    .qty-input::-webkit-inner-spin-button { -webkit-appearance: none; }

    .qty-input:focus { border-color: var(--volt); }

    .btn-qty-update {
        width: 32px; height: 32px;
        background: transparent;
        border: 1px solid var(--line);
        color: var(--chalk-3);
        font-size: 0.7rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.18s;
        flex-shrink: 0;
    }

    .btn-qty-update:hover {
        background: var(--volt);
        border-color: var(--volt);
        color: var(--ink);
    }

    /* Subtotal cell */
    .cart-subtotal {
        font-family: var(--font-mono);
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--chalk);
    }

    /* Remove cell */
    .btn-remove {
        width: 32px; height: 32px;
        background: transparent;
        border: 1px solid transparent;
        color: var(--chalk-3);
        font-size: 0.75rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.18s;
        border-radius: 0;
        margin-left: auto;
    }

    .btn-remove:hover {
        background: rgba(255,63,63,0.1);
        border-color: var(--red-hot);
        color: var(--red-hot);
    }

    /* ── SUMMARY PANEL ── */
    .cart-summary {
        background: var(--ink-2);
        padding: 36px 32px;
        position: sticky;
        top: 0;
        border-left: 1px solid var(--line);
    }

    .summary-label {
        font-family: var(--font-mono);
        font-size: 0.6rem;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--volt);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .summary-label::before {
        content: '';
        display: inline-block;
        width: 18px; height: 2px;
        background: var(--volt);
    }

    .summary-line {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid var(--line);
    }

    .summary-line:last-of-type { border-bottom: none; }

    .summary-line-label {
        font-size: 0.85rem;
        color: var(--chalk-3);
    }

    .summary-line-val {
        font-family: var(--font-mono);
        font-size: 0.88rem;
        color: var(--chalk);
        font-weight: 700;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        padding: 20px 0 24px;
        border-top: 2px solid var(--line);
        margin-top: 8px;
    }

    .summary-total-label {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--chalk-3);
    }

    .summary-total-val {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 900;
        color: var(--chalk);
        line-height: 1;
    }

    /* Checkout button */
    .btn-checkout {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        background: var(--volt);
        color: var(--ink);
        border: none;
        padding: 18px 24px;
        font-family: var(--font-mono);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        text-decoration: none;
        cursor: pointer;
        transition: background 0.2s;
        margin-bottom: 12px;
    }

    .btn-checkout:hover {
        background: #d4f545;
        color: var(--ink) !important;
    }

    .btn-checkout i { font-size: 0.7rem; transition: transform 0.2s; }
    .btn-checkout:hover i { transform: translateX(4px); }

    /* Continue shopping */
    .btn-continue {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        background: transparent;
        color: var(--chalk-3);
        border: 1px solid var(--line);
        padding: 13px 24px;
        font-family: var(--font-mono);
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-continue:hover {
        border-color: var(--chalk-3);
        color: var(--chalk) !important;
        background: var(--ink-3);
    }

    /* Summary security note */
    .summary-note {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid var(--line);
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .summary-note i {
        font-size: 0.75rem;
        color: var(--chalk-3);
        margin-top: 2px;
        flex-shrink: 0;
    }

    .summary-note p {
        font-family: var(--font-mono);
        font-size: 0.58rem;
        letter-spacing: 0.06em;
        color: var(--chalk-3);
        line-height: 1.6;
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
    .anim.visible { animation: fadeUp 0.55s cubic-bezier(0.2,0,0.3,1) forwards; }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
        .cart-layout { grid-template-columns: 1fr; }
        .cart-summary { border-left: none; border-top: 1px solid var(--line); position: static; }
    }

    @media (max-width: 640px) {
        .cart-table-head { display: none; }
        .cart-row {
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto auto auto;
            gap: 12px;
            padding: 20px;
        }
        .cart-row > *:nth-child(1) { grid-column: span 2; }
        .cart-row > *:nth-child(5) { justify-self: end; }
    }
</style>
@endpush

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="cart-header">
    <div class="container-fluid px-4 px-lg-5">
        <div class="cart-header-eyebrow">Your Order</div>
        <h1>Shopping <em>Cart.</em></h1>
    </div>
</div>

<div class="container-fluid px-4 px-lg-5">

    {{-- ── ALERTS ── --}}
    @if(session('success'))
        <div class="cart-alert success anim" id="alertSuccess">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
            <button class="cart-alert-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="cart-alert error anim" id="alertError">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
            <button class="cart-alert-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    {{-- ── EMPTY STATE ── --}}
    @if(empty($cart))
        <div class="cart-empty anim">
            <i class="fas fa-shopping-cart cart-empty-icon"></i>
            <h3>Your Cart is Empty</h3>
            <p>You haven't added any tickets yet. Browse events and find something you'll love.</p>
            <a href="{{ route('events.index') }}" class="btn-view">
                Browse Events <i class="fas fa-arrow-right"></i>
            </a>
        </div>

    @else

        {{-- ── CART LAYOUT ── --}}
        <div class="cart-layout">

            {{-- LEFT: Items --}}
            <div class="cart-items-panel">

                {{-- Table header --}}
                <div class="cart-table-head">
                    <span>Event / Ticket</span>
                    <span>Type</span>
                    <span>Price</span>
                    <span>Qty</span>
                    <span></span>
                </div>

                {{-- Rows --}}
                @foreach($cart as $id => $item)
                    <div class="cart-row anim" style="animation-delay: {{ $loop->index * 0.06 }}s">

                        {{-- Event info --}}
                        <div>
                            <div class="cart-event-name">{{ $item['event_name'] }}</div>
                            <div class="cart-ticket-type">
                                <i class="fas fa-ticket-alt"></i>
                                {{ $item['ticket_type'] }}
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="cart-price">${{ number_format($item['price'], 2) }}</div>

                        {{-- Quantity --}}
                        <div>
                            <form action="{{ route('cart.update', $item['ticket_id']) }}"
                                  method="POST"
                                  class="update-cart-form qty-wrap">
                                @csrf
                                @method('PATCH')
                                <input type="number"
                                       name="quantity"
                                       class="qty-input"
                                       value="{{ $item['quantity'] }}"
                                       min="1"
                                       max="{{ $item['max_available'] }}">
                                <button type="submit" class="btn-qty-update" title="Update quantity">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </form>
                        </div>

                        {{-- Subtotal --}}
                        <div class="cart-subtotal">
                            ${{ number_format($item['price'] * $item['quantity'], 2) }}
                        </div>

                        {{-- Remove --}}
                        <div>
                            <form action="{{ route('cart.remove', $item['ticket_id']) }}"
                                  method="POST"
                                  class="remove-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-remove" title="Remove item">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach

            </div>

            {{-- RIGHT: Summary --}}
            <div class="cart-summary anim">
                <div class="summary-label">Order Summary</div>

                {{-- Line items --}}
                @foreach($cart as $id => $item)
                    <div class="summary-line">
                        <span class="summary-line-label">
                            {{ \Illuminate\Support\Str::limit($item['event_name'], 22) }}
                            <br>
                            <span style="font-size:0.75rem; opacity:0.6;">× {{ $item['quantity'] }}</span>
                        </span>
                        <span class="summary-line-val">
                            ${{ number_format($item['price'] * $item['quantity'], 2) }}
                        </span>
                    </div>
                @endforeach

                {{-- Total --}}
                <div class="summary-total">
                    <span class="summary-total-label">Total</span>
                    <span class="summary-total-val">${{ number_format($total, 2) }}</span>
                </div>

                {{-- CTA --}}
                <a href="{{ route('cart.checkout') }}" class="btn-checkout">
                    Proceed to Checkout <i class="fas fa-arrow-right"></i>
                </a>

                <a href="{{ route('events.index') }}" class="btn-continue">
                    <i class="fas fa-arrow-left"></i> Continue Shopping
                </a>

                {{-- Security note --}}
                <div class="summary-note">
                    <i class="fas fa-lock"></i>
                    <p>Secure checkout. Your payment info is encrypted and never stored on our servers.</p>
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
        form.addEventListener('submit', function (e) {
            const input = this.querySelector('input[name="quantity"]');
            const qty = parseInt(input.value);
            const min = parseInt(input.min);
            const max = parseInt(input.max);
            if (isNaN(qty) || qty < min || qty > max) {
                e.preventDefault();
                input.style.borderColor = 'var(--red-hot)';
                input.focus();
                setTimeout(() => input.style.borderColor = '', 2000);
            }
        });
    });

    // Remove confirmation
    document.querySelectorAll('.remove-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            if (!confirm('Remove this item from your cart?')) e.preventDefault();
        });
    });

    // Auto-dismiss alerts
    setTimeout(() => {
        document.querySelectorAll('.cart-alert').forEach(el => {
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
    }, { threshold: 0.05 });

    document.querySelectorAll('.anim').forEach(el => observer.observe(el));
</script>
@endpush