@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h1 class="mb-4">Checkout</h1>
        
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Order Summary</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
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
                                    <td>{{ $item['event_name'] }}</td>
                                    <td>{{ $item['ticket_type'] }}</td>
                                    <td>${{ number_format($item['price'], 2) }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="4" class="text-end"><strong>Total:</strong></td>
                                <td><strong>${{ number_format($total, 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Payment Method</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('cart.process') }}" method="POST" id="checkout-form">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Select Payment Method</label>
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" 
                                           id="cash" value="cash" required>
                                    <label class="form-check-label" for="cash">
                                        <i class="fas fa-money-bill"></i> Cash
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" 
                                           id="gcash" value="gcash">
                                    <label class="form-check-label" for="gcash">
                                        <i class="fas fa-mobile-alt"></i> GCash
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" 
                                           id="credit_card" value="credit_card">
                                    <label class="form-check-label" for="credit_card">
                                        <i class="fas fa-credit-card"></i> Credit Card
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" 
                                           id="paypal" value="paypal">
                                    <label class="form-check-label" for="paypal">
                                        <i class="fab fa-paypal"></i> PayPal
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('payment_method')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('cart.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Cart
                        </a>
                        <button type="submit" class="btn btn-success btn-lg" id="submit-btn">
                            <i class="fas fa-check-circle"></i> Complete Purchase
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Order Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Items:</strong> {{ count($cart) }}</p>
                <p><strong>Total Tickets:</strong> 
                    {{ collect($cart)->sum('quantity') }}
                </p>
                <p><strong>Total Amount:</strong> 
                    <span class="text-success fw-bold">${{ number_format($total, 2) }}</span>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#checkout-form').on('submit', function() {
        $('#submit-btn').prop('disabled', true).html(
            '<i class="fas fa-spinner fa-spin"></i> Processing...'
        );
    });
});
</script>
@endpush