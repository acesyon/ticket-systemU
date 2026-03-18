@extends('layouts.app')

@section('title', 'Checkout')

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
    .checkout-header {
        padding: 60px 0 32px;
        background: linear-gradient(to bottom, var(--white), var(--off-white));
        border-bottom: 1px solid var(--border);
    }

    .checkout-header-eyebrow {
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

    .checkout-header h1 {
        font-size: clamp(36px, 4vw, 48px);
        font-weight: 700;
        color: var(--text-primary);
        letter-spacing: -0.02em;
        line-height: 1.1;
    }

    .checkout-header h1 em {
        font-style: normal;
        color: var(--accent);
    }

    /* Layout */
    .checkout-layout {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 32px;
        align-items: start;
        margin: 32px 0 60px;
    }

    /* Cards */
    .checkout-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        margin-bottom: 24px;
    }

    .checkout-card:last-child {
        margin-bottom: 0;
    }

    .checkout-card-header {
        padding: 20px 24px;
        background: var(--off-white);
        border-bottom: 1px solid var(--border);
    }

    .checkout-card-header h5 {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .checkout-card-header h5 i {
        color: var(--accent);
        font-size: 18px;
    }

    .checkout-card-body {
        padding: 24px;
    }

    /* Order Summary Table */
    .order-summary-table {
        width: 100%;
        border-collapse: collapse;
    }

    .order-summary-table thead th {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.03em;
        padding: 0 0 12px 0;
        border-bottom: 1px solid var(--border);
    }

    .order-summary-table tbody td {
        padding: 16px 0;
        border-bottom: 1px solid var(--border);
        color: var(--text-primary);
        font-size: 14px;
    }

    .order-summary-table tbody tr:last-child td {
        border-bottom: none;
    }

    .order-summary-table tfoot td {
        padding-top: 16px;
        font-size: 15px;
    }

    .order-summary-table tfoot .total-label {
        font-weight: 600;
        color: var(--text-primary);
    }

    .order-summary-table tfoot .total-value {
        font-weight: 700;
        color: var(--text-primary);
        font-size: 18px;
    }

    .order-event-name {
        font-weight: 500;
        color: var(--text-primary);
    }

    .order-ticket-type {
        color: var(--text-tertiary);
        font-size: 13px;
    }

    .order-price,
    .order-qty,
    .order-subtotal {
        font-weight: 500;
    }

    /* Payment Methods */
    .payment-methods-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-bottom: 8px;
    }

    .payment-method {
        position: relative;
    }

    .payment-method input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .payment-method label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 20px 12px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
    }

    .payment-method input[type="radio"]:checked + label {
        border-color: var(--accent);
        background: var(--accent-soft);
        box-shadow: var(--shadow-sm);
    }

    .payment-method label:hover {
        border-color: var(--accent);
        background: var(--off-white);
    }

    .payment-method i {
        font-size: 24px;
        color: var(--accent);
    }

    .payment-method span {
        font-size: 13px;
        font-weight: 500;
        color: var(--text-primary);
    }

    .payment-method input[type="radio"]:checked + label span {
        color: var(--accent);
    }

    /* Order Details Sidebar */
    .checkout-sidebar {
        position: sticky;
        top: 100px;
    }

    .order-details-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .order-details-header {
        padding: 20px 24px;
        background: var(--off-white);
        border-bottom: 1px solid var(--border);
    }

    .order-details-header h5 {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .order-details-header h5 i {
        color: var(--accent);
        font-size: 18px;
    }

    .order-details-body {
        padding: 24px;
    }

    .order-detail-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px dashed var(--border);
    }

    .order-detail-item:last-child {
        border-bottom: none;
    }

    .order-detail-label {
        color: var(--text-secondary);
        font-size: 14px;
    }

    .order-detail-value {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 14px;
    }

    .order-detail-value.total {
        font-size: 20px;
        font-weight: 700;
        color: var(--accent);
    }

    /* Action Buttons */
    .checkout-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 24px;
        padding-top: 24px;
        border-top: 1px solid var(--border);
    }

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

    .btn-complete {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 32px;
        background: var(--accent);
        border: none;
        border-radius: var(--radius-sm);
        color: white;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-complete:hover {
        background: var(--accent-light);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-complete i {
        transition: transform 0.2s;
    }

    .btn-complete:hover i {
        transform: translateX(4px);
    }

    .btn-complete:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    /* Error States */
    .error-message {
        color: var(--error);
        font-size: 13px;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .error-message i {
        font-size: 14px;
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
        .checkout-layout {
            grid-template-columns: 1fr;
        }

        .checkout-sidebar {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .container-custom {
            padding: 0 20px;
        }

        .checkout-header {
            padding: 40px 0 24px;
        }

        .payment-methods-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .order-summary-table thead {
            display: none;
        }

        .order-summary-table tbody tr {
            display: block;
            padding: 16px 0;
            border-bottom: 1px solid var(--border);
        }

        .order-summary-table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px dashed var(--border);
        }

        .order-summary-table tbody td:last-child {
            border-bottom: none;
        }

        .order-summary-table tbody td::before {
            content: attr(data-label);
            color: var(--text-tertiary);
            font-size: 13px;
            font-weight: 400;
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
    }
</style>
@endpush

@section('content')

{{-- Page Header --}}
<div class="checkout-header">
    <div class="container-custom">
        <span class="checkout-header-eyebrow">Secure Checkout</span>
        <h1>Complete Your <em class="text-gradient">Purchase</em></h1>
    </div>
</div>

<div class="container-custom">
    <div class="checkout-layout">
        {{-- Main Content --}}
        <div class="checkout-main">
            {{-- Order Summary Card --}}
            <div class="checkout-card anim">
                <div class="checkout-card-header">
                    <h5>
                        <i class="bi bi-bag-check"></i>
                        Order Summary
                    </h5>
                </div>
                <div class="checkout-card-body">
                    <div class="table-responsive">
                        <table class="order-summary-table">
                            <thead>
                                <tr>
                                    <th>Event</th>
                                    <th>Ticket</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $item)
                                    <tr>
                                        <td>
                                            <div class="order-event-name">{{ $item['event_name'] ?? 'Event' }}</div>
                                        </td>
                                        <td>
                                            <span class="order-ticket-type">{{ $item['ticket_type'] ?? 'Standard' }}</span>
                                        </td>
                                        <td data-label="Price" class="order-price">${{ number_format($item['price'] ?? 0, 2) }}</td>
                                        <td data-label="Qty" class="order-qty">{{ $item['quantity'] ?? 1 }}</td>
                                        <td data-label="Subtotal" class="order-subtotal">
                                            ${{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end total-label"><strong>Total:</strong></td>
                                    <td class="total-value"><strong>${{ number_format($total ?? 0, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Payment Method Card --}}
            <div class="checkout-card anim" style="animation-delay: 0.1s">
                <div class="checkout-card-header">
                    <h5>
                        <i class="bi bi-credit-card"></i>
                        Payment Method
                    </h5>
                </div>
                <div class="checkout-card-body">
                    <form action="{{ route('cart.process') }}" method="POST" id="checkout-form">
                        @csrf
                        
                        <div class="payment-methods-grid">
                            <div class="payment-method">
                                <input type="radio" name="payment_method" id="cash" value="cash" required>
                                <label for="cash">
                                    <i class="bi bi-cash"></i>
                                    <span>Cash</span>
                                </label>
                            </div>
                            
                            <div class="payment-method">
                                <input type="radio" name="payment_method" id="gcash" value="gcash">
                                <label for="gcash">
                                    <i class="bi bi-phone"></i>
                                    <span>GCash</span>
                                </label>
                            </div>
                            
                            <div class="payment-method">
                                <input type="radio" name="payment_method" id="credit_card" value="credit_card">
                                <label for="credit_card">
                                    <i class="bi bi-credit-card-2-front"></i>
                                    <span>Credit Card</span>
                                </label>
                            </div>
                            
                            <div class="payment-method">
                                <input type="radio" name="payment_method" id="paypal" value="paypal">
                                <label for="paypal">
                                    <i class="bi bi-paypal"></i>
                                    <span>PayPal</span>
                                </label>
                            </div>
                        </div>
                        
                        @error('payment_method')
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
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

        {{-- Sidebar --}}
        <div class="checkout-sidebar">
            <div class="order-details-card anim" style="animation-delay: 0.2s">
                <div class="order-details-header">
                    <h5>
                        <i class="bi bi-receipt"></i>
                        Order Details
                    </h5>
                </div>
                <div class="order-details-body">
                    <div class="order-detail-item">
                        <span class="order-detail-label">Items:</span>
                        <span class="order-detail-value">{{ count($cart) }}</span>
                    </div>
                    
                    <div class="order-detail-item">
                        <span class="order-detail-label">Total Tickets:</span>
                        <span class="order-detail-value">{{ collect($cart)->sum('quantity') }}</span>
                    </div>
                    
                    <div class="order-detail-item">
                        <span class="order-detail-label">Subtotal:</span>
                        <span class="order-detail-value">${{ number_format($total ?? 0, 2) }}</span>
                    </div>
                    
                    <div class="order-detail-item">
                        <span class="order-detail-label">Tax:</span>
                        <span class="order-detail-value">Calculated at checkout</span>
                    </div>
                    
                    <div class="order-detail-item">
                        <span class="order-detail-label total">Total Amount:</span>
                        <span class="order-detail-value total">${{ number_format($total ?? 0, 2) }}</span>
                    </div>
                </div>
            </div>

            {{-- Security Note --}}
            <div class="checkout-card" style="margin-top: 16px; background: var(--off-white);">
                <div class="checkout-card-body" style="padding: 16px;">
                    <div style="display: flex; align-items: flex-start; gap: 12px;">
                        <i class="bi bi-shield-check" style="color: var(--success); font-size: 20px;"></i>
                        <div>
                            <p style="color: var(--text-secondary); font-size: 13px; line-height: 1.5; margin: 0;">
                                Your payment information is encrypted and secure. We never store your credit card details.
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
        const form = document.getElementById('checkout-form');
        const submitBtn = document.getElementById('submit-btn');

        if (form) {
            form.addEventListener('submit', function() {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner"></i> Processing...';
            });
        }

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

<style>
    .spinner {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
@endpush