@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Order Details #{{ $order->orderID }}</h1>
            <div>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Orders
                </a>
                @if($order->status === 'completed')
                    <a href="{{ route('orders.download', $order) }}" class="btn btn-success">
                        <i class="fas fa-download"></i> Download Ticket
                    </a>
                @endif
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Event Information</h5>
                    </div>
                    <div class="card-body">
                        <h4>{{ $order->ticket->event->event_name }}</h4>
                        
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p>
                                    <i class="fas fa-calendar text-primary"></i>
                                    <strong>Date:</strong> 
                                    {{ \Carbon\Carbon::parse($order->ticket->event->eventDate)->format('F d, Y') }}
                                </p>
                                <p>
                                    <i class="fas fa-clock text-primary"></i>
                                    <strong>Time:</strong> 
                                    {{ \Carbon\Carbon::parse($order->ticket->event->eventTime)->format('h:i A') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                    <strong>Location:</strong> {{ $order->ticket->event->location }}
                                </p>
                                <p>
                                    <i class="fas fa-ticket-alt text-primary"></i>
                                    <strong>Ticket Type:</strong> {{ $order->ticket->ticketType }}
                                </p>
                            </div>
                        </div>
                        
                        <p class="mt-3">
                            <strong>Description:</strong><br>
                            {{ $order->ticket->event->description }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <td>Order ID:</td>
                                <td class="text-end"><strong>#{{ $order->orderID }}</strong></td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td class="text-end">
                                    <span class="badge bg-{{ $order->status === 'completed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Quantity:</td>
                                <td class="text-end">{{ $order->quantity }}</td>
                            </tr>
                            <tr>
                                <td>Price per ticket:</td>
                                <td class="text-end">${{ number_format($order->ticket->price, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Subtotal:</td>
                                <td class="text-end">${{ number_format($order->ticket->price * $order->quantity, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Payment Method:</td>
                                <td class="text-end">{{ ucfirst(str_replace('_', ' ', $order->payment->payment_method)) }}</td>
                            </tr>
                            <tr>
                                <td>Date Purchased:</td>
                                <td class="text-end">{{ $order->date_purchased->format('M d, Y h:i A') }}</td>
                            </tr>
                            <tr class="table-light">
                                <td><strong>Total Amount:</strong></td>
                                <td class="text-end"><strong>${{ number_format($order->payment->payment, 2) }}</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection