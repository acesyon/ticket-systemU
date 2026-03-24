@extends('layouts.app')

@section('title', 'Checkout')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,600;0,9..144,700;1,9..144,300&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* ═══════════════════════════════════════════════════════════════════════════
   TOKENS — consistent with home & cart pages
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
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 40px;
}

/* ═══════════════════════════════════════════════════════════════════════════
   PAGE HEADER — elegant with gold accent
═══════════════════════════════════════════════════════════════════════════ */
.checkout-header {
    background: var(--ink);
    padding: 64px 0 56px;
    position: relative;
    overflow: hidden;
}

.checkout-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
    background-size: 32px 32px;
    pointer-events: none;
}

.checkout-header::after {
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

.checkout-header h1 {
    font-family: var(--f-display);
    font-size: clamp(48px, 6vw, 72px);
    font-weight: 600;
    line-height: 1.0;
    letter-spacing: -0.03em;
    color: var(--white);
}

.checkout-header h1 em {
    font-style: italic;
    font-weight: 300;
    color: var(--gold);
}

/* ═══════════════════════════════════════════════════════════════════════════
   CHECKOUT LAYOUT
═══════════════════════════════════════════════════════════════════════════ */
.checkout-grid {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 40px;
    margin: 48px 0 80px;
    align-items: start;
}

/* ──────────────────────────────────────────────────────────────────────────
   Cards — consistent with cart panel
────────────────────────────────────────────────────────────────────────── */
.checkout-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    margin-bottom: 28px;
}

.checkout-card:last-child {
    margin-bottom: 0;
}

.card-header {
    padding: 20px 28px;
    background: var(--mist-2);
    border-bottom: 1px solid var(--border);
}

.card-header h2 {
    font-family: var(--f-display);
    font-size: 18px;
    font-weight: 600;
    color: var(--ink);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
    letter-spacing: -0.02em;
}

.card-header h2 i {
    color: var(--gold);
    font-size: 20px;
}

.card-body {
    padding: 28px;
}

/* ═══════════════════════════════════════════════════════════════════════════
   ORDER SUMMARY TABLE — refined
═══════════════════════════════════════════════════════════════════════════ */
.order-table {
    width: 100%;
    border-collapse: collapse;
}

.order-table thead th {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
    padding: 0 0 16px 0;
    border-bottom: 1px solid var(--border);
    text-align: left;
}

.order-table thead th:last-child {
    text-align: right;
}

.order-table tbody td {
    padding: 18px 0;
    border-bottom: 1px solid var(--border);
    vertical-align: top;
}

.order-table tbody tr:last-child td {
    border-bottom: none;
}

.order-table tfoot td {
    padding-top: 20px;
    border-top: 2px solid var(--border);
}

.event-name {
    font-family: var(--f-display);
    font-size: 16px;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 6px;
    letter-spacing: -0.02em;
}

.ticket-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--gold-soft);
    padding: 4px 10px;
    border-radius: 100px;
    font-size: 11px;
    font-weight: 600;
    color: #8a6a1a;
}

.ticket-badge i {
    font-size: 10px;
}

.order-price, .order-qty, .order-subtotal {
    font-weight: 500;
    color: var(--ink);
}

.order-subtotal {
    font-weight: 600;
    text-align: right;
}

.total-row td {
    padding-top: 20px;
}

.total-label {
    font-family: var(--f-display);
    font-size: 20px;
    font-weight: 600;
    color: var(--ink);
    text-align: right;
}

.total-value {
    font-family: var(--f-display);
    font-size: 26px;
    font-weight: 700;
    color: var(--gold);
    text-align: right;
}

/* ═══════════════════════════════════════════════════════════════════════════
   PAYMENT METHODS — elegant card selection
═══════════════════════════════════════════════════════════════════════════ */
.payment-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}

.payment-option {
    position: relative;
}

.payment-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.payment-option label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
    padding: 20px 12px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    cursor: pointer;
    transition: all 0.25s ease;
    text-align: center;
}

.payment-option input[type="radio"]:checked + label {
    border-color: var(--gold);
    background: var(--gold-soft);
    box-shadow: 0 4px 12px rgba(201,168,76,0.15);
}

.payment-option label:hover {
    border-color: var(--gold);
    transform: translateY(-2px);
}

.payment-option i {
    font-size: 28px;
    color: var(--gold);
}

.payment-option span {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-body);
}

.payment-option input[type="radio"]:checked + label span {
    color: var(--gold);
}

/* Error message */
.error-message {
    display: flex;
    align-items: center;
    gap: 8px;
    background: var(--error-soft);
    padding: 12px 16px;
    border-radius: var(--r-md);
    color: var(--error);
    font-size: 13px;
    font-weight: 500;
    margin-top: 16px;
}

.error-message i {
    font-size: 16px;
}

/* ═══════════════════════════════════════════════════════════════════════════
   SIDEBAR — order details card
═══════════════════════════════════════════════════════════════════════════ */
.sidebar-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    position: sticky;
    top: 100px;
}

.sidebar-header {
    padding: 20px 28px;
    background: var(--mist-2);
    border-bottom: 1px solid var(--border);
}

.sidebar-header h3 {
    font-family: var(--f-display);
    font-size: 18px;
    font-weight: 600;
    color: var(--ink);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.sidebar-header h3 i {
    color: var(--gold);
}

.sidebar-body {
    padding: 24px 28px;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 0;
    border-bottom: 1px dashed var(--border);
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    color: var(--text-muted);
    font-size: 14px;
}

.detail-value {
    font-weight: 600;
    color: var(--ink);
    font-size: 14px;
}

.detail-value.total {
    font-family: var(--f-display);
    font-size: 24px;
    font-weight: 700;
    color: var(--gold);
}

/* Security note */
.security-note {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid var(--border);
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.security-note i {
    color: var(--success);
    font-size: 18px;
    flex-shrink: 0;
}

.security-note p {
    font-size: 12px;
    color: var(--text-muted);
    line-height: 1.5;
    margin: 0;
}

/* ═══════════════════════════════════════════════════════════════════════════
   ACTION BUTTONS
═══════════════════════════════════════════════════════════════════════════ */
.checkout-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 28px;
    padding-top: 24px;
    border-top: 1px solid var(--border);
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: transparent;
    color: var(--text-muted);
    font-weight: 500;
    font-size: 14px;
    padding: 12px 20px;
    border-radius: var(--r-md);
    text-decoration: none;
    border: 1px solid var(--border);
    transition: all 0.2s;
}

.btn-back:hover {
    border-color: var(--gold);
    color: var(--gold);
    background: var(--gold-soft);
}

.btn-back i {
    transition: transform 0.2s;
}

.btn-back:hover i {
    transform: translateX(-4px);
}

.btn-complete {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--gold);
    color: var(--ink);
    font-weight: 600;
    font-size: 14px;
    padding: 14px 32px;
    border-radius: var(--r-md);
    border: none;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-complete:hover {
    background: var(--gold-light);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(201,168,76,0.25);
}

.btn-complete:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.btn-complete i {
    transition: transform 0.2s;
}

.btn-complete:hover i {
    transform: translateX(4px);
}

/* Spinner animation */
.spinner {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
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
    .checkout-grid {
        grid-template-columns: 1fr;
        gap: 32px;
    }
    
    .sidebar-card {
        position: static;
    }
}

@media (max-width: 768px) {
    .wrap {
        padding: 0 20px;
    }
    
    .checkout-header {
        padding: 48px 0 40px;
    }
    
    .payment-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
    
    .payment-option label {
        padding: 16px 12px;
    }
    
    .order-table thead {
        display: none;
    }
    
    .order-table tbody tr {
        display: block;
        padding: 20px 0;
        border-bottom: 1px solid var(--border);
    }
    
    .order-table tbody tr:last-child {
        border-bottom: none;
    }
    
    .order-table tbody td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: none;
    }
    
    .order-table tbody td::before {
        content: attr(data-label);
        color: var(--text-muted);
        font-size: 12px;
        font-weight: 500;
    }
    
    .order-table tbody td:last-child {
        padding-bottom: 0;
    }
    
    .event-name {
        font-size: 15px;
    }
    
    .checkout-actions {
        flex-direction: column-reverse;
        gap: 12px;
    }
    
    .btn-back,
    .btn-complete {
        width: 100%;
        justify-content: center;
    }
    
    .card-header {
        padding: 16px 20px;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .sidebar-header {
        padding: 16px 20px;
    }
    
    .sidebar-body {
        padding: 20px;
    }
}

@media (max-width: 480px) {
    .payment-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════════════════════════════════════
     HERO SECTION — matches home & cart pages
═══════════════════════════════════════════════════════════════════════════ --}}
<div class="checkout-header">
    <div class="wrap">
        <div class="header-eyebrow">Secure Checkout</div>
        <h1>Complete Your <em>Purchase</em></h1>
    </div>
</div>

<div class="wrap">
    {{-- ══ CHECKOUT GRID ═══════════════════════════════════════════════════════ --}}
    <div class="checkout-grid">

        {{-- LEFT COLUMN: Order Summary + Payment Method --}}
        <div class="checkout-main">
            
            {{-- Order Summary Card --}}
            <div class="checkout-card anim-fade">
                <div class="card-header">
                    <h2>
                        <i class="bi bi-receipt"></i>
                        Order Summary
                    </h2>
                </div>
                <div class="card-body">
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Event & Ticket</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cart as $item)
                                @php
                                    $eventName = $item['event_name'] ?? $item['event']['name'] ?? 'Event';
                                    $ticketType = $item['ticket_type'] ?? $item['ticket']['type'] ?? 'Standard';
                                    $price = $item['price'] ?? $item['ticket']['price'] ?? 0;
                                    $quantity = $item['quantity'] ?? 1;
                                    $subtotal = $price * $quantity;
                                @endphp
                                <tr>
                                    <td data-label="Event">
                                        <div class="event-name">{{ Str::limit($eventName, 55) }}</div>
                                        <span class="ticket-badge">
                                            <i class="bi bi-ticket-perforated"></i>
                                            {{ $ticketType }}
                                        </span>
                                    </td>
                                    <td data-label="Price" class="order-price">
                                        ${{ number_format($price, 2) }}
                                    </td>
                                    <td data-label="Qty" class="order-qty">
                                        ×{{ $quantity }}
                                    </td>
                                    <td data-label="Subtotal" class="order-subtotal">
                                        ${{ number_format($subtotal, 2) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 40px;">
                                        <i class="bi bi-cart-x" style="font-size: 32px; color: var(--text-muted);"></i>
                                        <p style="margin-top: 12px; color: var(--text-muted);">Your cart is empty</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if(!empty($cart) && count($cart) > 0)
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="3" class="total-label">Total</td>
                                <td class="total-value">${{ number_format($total ?? 0, 2) }}</td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>

            {{-- Payment Method Card --}}
            <div class="checkout-card anim-fade" style="animation-delay: 0.08s">
                <div class="card-header">
                    <h2>
                        <i class="bi bi-credit-card"></i>
                        Payment Method
                    </h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('cart.process') }}" method="POST" id="checkout-form">
                        @csrf
                        
                        <div class="payment-grid">
                            <div class="payment-option">
                                <input type="radio" name="payment_method" id="cash" value="cash" {{ old('payment_method') == 'cash' ? 'checked' : '' }} required>
                                <label for="cash">
                                    <i class="bi bi-cash-stack"></i>
                                    <span>Cash</span>
                                </label>
                            </div>
                            
                            <div class="payment-option">
                                <input type="radio" name="payment_method" id="gcash" value="gcash" {{ old('payment_method') == 'gcash' ? 'checked' : '' }}>
                                <label for="gcash">
                                    <i class="bi bi-phone"></i>
                                    <span>GCash</span>
                                </label>
                            </div>
                            
                            <div class="payment-option">
                                <input type="radio" name="payment_method" id="credit_card" value="credit_card" {{ old('payment_method') == 'credit_card' ? 'checked' : '' }}>
                                <label for="credit_card">
                                    <i class="bi bi-credit-card-2-front"></i>
                                    <span>Credit Card</span>
                                </label>
                            </div>
                            
                            <div class="payment-option">
                                <input type="radio" name="payment_method" id="paypal" value="paypal" {{ old('payment_method') == 'paypal' ? 'checked' : '' }}>
                                <label for="paypal">
                                    <i class="bi bi-paypal"></i>
                                    <span>PayPal</span>
                                </label>
                            </div>
                        </div>
                        
                        @error('payment_method')
                            <div class="error-message">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                {{ $message }}
                            </div>
                        @enderror

                        {{-- Action Buttons --}}
                        <div class="checkout-actions">
                            <a href="{{ route('cart.index') }}" class="btn-back">
                                <i class="bi bi-arrow-left"></i>
                                Back to Cart
                            </a>
                            <button type="submit" class="btn-complete" id="submit-btn">
                                <i class="bi bi-check-circle"></i>
                                Complete Purchase
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN: Order Details Sidebar --}}
        <div class="checkout-sidebar">
            <div class="sidebar-card anim-fade" style="animation-delay: 0.15s">
                <div class="sidebar-header">
                    <h3>
                        <i class="bi bi-file-text"></i>
                        Order Details
                    </h3>
                </div>
                <div class="sidebar-body">
                    <div class="detail-row">
                        <span class="detail-label">Items</span>
                        <span class="detail-value">{{ count($cart ?? []) }} ticket type(s)</span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="detail-label">Total Tickets</span>
                        <span class="detail-value">{{ collect($cart ?? [])->sum('quantity') }} ticket(s)</span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="detail-label">Subtotal</span>
                        <span class="detail-value">${{ number_format($total ?? 0, 2) }}</span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="detail-label">Tax & Fees</span>
                        <span class="detail-value">Calculated at checkout</span>
                    </div>
                    
                    <div class="detail-row" style="margin-top: 8px; padding-top: 16px; border-top: 2px solid var(--border);">
                        <span class="detail-label total">Total Amount</span>
                        <span class="detail-value total">${{ number_format($total ?? 0, 2) }}</span>
                    </div>

                    {{-- Security Note --}}
                    <div class="security-note">
                        <i class="bi bi-shield-check"></i>
                        <p>Your payment information is encrypted and secure. We never store your credit card details.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
(function() {
    const form = document.getElementById('checkout-form');
    const submitBtn = document.getElementById('submit-btn');

    if (form && submitBtn) {
        form.addEventListener('submit', function(e) {
            // Validate payment method selection
            const selectedPayment = document.querySelector('input[name="payment_method"]:checked');
            if (!selectedPayment) {
                e.preventDefault();
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message';
                errorDiv.innerHTML = '<i class="bi bi-exclamation-triangle-fill"></i> Please select a payment method to continue.';
                
                const existingError = form.querySelector('.error-message:not([data-form-error])');
                if (existingError) existingError.remove();
                
                const paymentGrid = form.querySelector('.payment-grid');
                paymentGrid.insertAdjacentElement('afterend', errorDiv);
                errorDiv.setAttribute('data-form-error', 'true');
                
                errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }
            
            // Disable button and show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner"></i> Processing...';
        });
    }

    // Auto-remove error when payment method is selected
    const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
    paymentRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            const errorDiv = document.querySelector('.error-message[data-form-error]');
            if (errorDiv) {
                errorDiv.style.transition = 'opacity 0.3s';
                errorDiv.style.opacity = '0';
                setTimeout(() => errorDiv.remove(), 300);
            }
        });
    });

    // Intersection Observer for scroll animations
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