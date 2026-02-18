@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4">My Orders</h1>
        
        @if($orders->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-shopping-bag fa-3x mb-3"></i>
                <p>You haven't placed any orders yet.</p>
                <a href="{{ route('events.index') }}" class="btn btn-primary">
                    Browse Events
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Event</th>
                            <th>Ticket Type</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->orderID }}</td>
                                <td>{{ $order->ticket->event->event_name }}</td>
                                <td>{{ $order->ticket->ticketType }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>${{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    @if($order->status === 'completed')
                                        <a href="{{ route('orders.download', $order) }}" class="btn btn-sm btn-success">
                                            <i class="fas fa-download"></i> Ticket
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection