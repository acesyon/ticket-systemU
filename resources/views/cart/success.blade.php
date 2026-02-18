@extends('layouts.app')

@section('title', 'Order Successful')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-success">
            <div class="card-header bg-success text-white text-center py-3">
                <h4 class="mb-0">
                    <i class="fas fa-check-circle"></i> Payment Successful!
                </h4>
            </div>
            <div class="card-body text-center py-4">
                <i class="fas fa-check-circle text-success fa-5x mb-3"></i>
                <h3>Thank You for Your Purchase!</h3>
                <p class="lead">Your order has been confirmed.</p>
                
                <div class="alert alert-info mt-4">
                    <p class="mb-0"><strong>Order ID:</strong> #{{ $order->orderID }}</p>
                    <p class="mb-0"><strong>Total Amount:</strong> ${{ number_format($order->payment->payment, 2) }}</p>
                    <p class="mb-0"><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment->payment_method)) }}</p>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-primary">
                        <i class="fas fa-eye"></i> View Order
                    </a>
                    <a href="{{ route('orders.download', $order) }}" class="btn btn-success">
                        <i class="fas fa-download"></i> Download Ticket
                    </a>
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">
                        <i class="fas fa-calendar"></i> Browse More Events
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection