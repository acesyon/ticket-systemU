@extends('layouts.app')

@section('title', 'Download Ticket #{{ $order->id }}')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="d-flex justify-content-between align-items-center mb-4 d-print-none">
            <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Order
            </a>
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print"></i> Print Ticket
            </button>
        </div>

        {{-- Ticket Card --}}
        <div class="card shadow-lg border-0" id="ticket">
            {{-- Header --}}
            <div class="card-header bg-primary text-white text-center py-4">
                <h2 class="mb-1"><i class="fas fa-ticket-alt"></i> E-Ticket</h2>
                <p class="mb-0 opacity-75">{{ config('app.name') }}</p>
            </div>

            <div class="card-body p-4">
                {{-- Event Name --}}
                <div class="text-center mb-4">
                    <h3 class="fw-bold">{{ $order->ticket->event->name }}</h3>
                    <span class="badge bg-success fs-6">{{ $order->ticket->ticket_type }}</span>
                </div>

                <hr>

                {{-- Event Details --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="mb-2">
                            <i class="fas fa-calendar text-primary me-2"></i>
                            <strong>Date:</strong>
                            {{ \Carbon\Carbon::parse($order->ticket->event->date)->format('F d, Y') }}
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-clock text-primary me-2"></i>
                            <strong>Time:</strong>
                            {{ \Carbon\Carbon::parse($order->ticket->event->time)->format('h:i A') }}
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <strong>Location:</strong>
                            {{ $order->ticket->event->location }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2">
                            <i class="fas fa-hashtag text-primary me-2"></i>
                            <strong>Order ID:</strong> #{{ $order->id }}
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-users text-primary me-2"></i>
                            <strong>Quantity:</strong> {{ $order->quantity }} ticket(s)
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-money-bill text-primary me-2"></i>
                            <strong>Amount Paid:</strong> ${{ number_format($order->payment->amount, 2) }}
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-credit-card text-primary me-2"></i>
                            <strong>Payment:</strong>
                            {{ ucfirst(str_replace('_', ' ', $order->payment->payment_method)) }}
                        </p>
                    </div>
                </div>

                <hr>

                {{-- Attendee Details --}}
                <div class="mb-4">
                    <h5 class="fw-bold mb-3"><i class="fas fa-user text-primary me-2"></i>Attendee</h5>
                    <p class="mb-1">
                        <strong>Name:</strong>
                        {{ $order->user->first_name }} {{ $order->user->middle_name ? $order->user->middle_name . ' ' : '' }}{{ $order->user->last_name }}
                    </p>
                    <p class="mb-1">
                        <strong>Email:</strong> {{ $order->user->email }}
                    </p>
                    @if($order->user->contact_no)
                        <p class="mb-1">
                            <strong>Contact:</strong> {{ $order->user->contact_no }}
                        </p>
                    @endif
                </div>

                <hr>

                {{-- Footer --}}
                <div class="text-center text-muted mt-3">
                    <small>
                        Purchased on {{ \Carbon\Carbon::parse($order->date_purchased)->format('F d, Y h:i A') }}
                        &bull; Please present this ticket at the entrance.
                    </small>
                </div>
            </div>

            {{-- Status Banner --}}
            <div class="card-footer bg-success text-white text-center py-3">
                <i class="fas fa-check-circle me-2"></i>
                <strong>CONFIRMED &mdash; {{ strtoupper($order->ticket->ticket_type) }}</strong>
            </div>
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
    @media print {
        .d-print-none { display: none !important; }
        body { background: white !important; }
        .card { box-shadow: none !important; border: 1px solid #ddd !important; }
        .card-header { background-color: #0d6efd !important; -webkit-print-color-adjust: exact; }
        .card-footer { background-color: #198754 !important; -webkit-print-color-adjust: exact; }
        .badge { -webkit-print-color-adjust: exact; }
    }
</style>
@endpush
