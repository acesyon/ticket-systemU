@extends('layouts.app')

@section('title', $event->event_name)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h1 class="card-title mb-3">{{ $event->event_name }}</h1>
                
                <div class="mb-4">
                    <p class="mb-2">
                        <i class="fas fa-calendar text-primary fa-lg me-2"></i>
                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($event->eventDate)->format('l, F d, Y') }}
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-clock text-primary fa-lg me-2"></i>
                        <strong>Time:</strong> {{ \Carbon\Carbon::parse($event->eventTime)->format('h:i A') }}
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-map-marker-alt text-primary fa-lg me-2"></i>
                        <strong>Location:</strong> {{ $event->location }}
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-info-circle text-primary fa-lg me-2"></i>
                        <strong>Status:</strong> 
                        <span class="badge bg-{{ $event->status === 'upcoming' ? 'success' : ($event->status === 'ongoing' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($event->status) }}
                        </span>
                    </p>
                </div>
                
                <h5 class="mb-3">Description</h5>
                <p class="card-text">{{ $event->description }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Available Tickets</h5>
            </div>
            <div class="card-body">
                @forelse($event->tickets as $ticket)
                    <div class="mb-3 pb-3 border-bottom">
                        <h6>{{ $ticket->ticketType }}</h6>
                        <p class="mb-1">Price: <strong>${{ number_format($ticket->price, 2) }}</strong></p>
                        <p class="mb-2">Available: {{ $ticket->quantity_available }}</p>
                        
                        @auth
                            @if($ticket->quantity_available > 0 && $event->status === 'upcoming')
                                <form action="{{ route('cart.add', $ticket) }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <div class="input-group">
                                        <input type="number" name="quantity" class="form-control" 
                                               value="1" min="1" max="{{ $ticket->quantity_available }}">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-cart-plus"></i> Add to Cart
                                        </button>
                                    </div>
                                </form>
                            @elseif($ticket->quantity_available <= 0)
                                <button class="btn btn-secondary w-100" disabled>Sold Out</button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">
                                Login to Purchase
                            </a>
                        @endauth
                    </div>
                @empty
                    <p class="text-muted mb-0">No tickets available for this event.</p>
                @endforelse
            </div>
        </div>
        
        <div class="mt-3">
            <a href="{{ route('events.index') }}" class="btn btn-outline-secondary w-100">
                <i class="fas fa-arrow-left"></i> Back to Events
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.add-to-cart-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var quantity = form.find('input[name="quantity"]').val();
        var max = form.find('input[name="quantity"]').attr('max');
        
        if (parseInt(quantity) < 1 || parseInt(quantity) > parseInt(max)) {
            alert('Please enter a valid quantity between 1 and ' + max);
            return false;
        }
        
        form.unbind('submit').submit();
    });
});
</script>
@endpush