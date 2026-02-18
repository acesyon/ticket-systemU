@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4">Shopping Cart</h1>
        
        @if(empty($cart))
            <div class="alert alert-info text-center">
                <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                <p>Your cart is empty.</p>
                <a href="{{ route('events.index') }}" class="btn btn-primary">
                    Browse Events
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Event</th>
                            <th>Ticket Type</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $id => $item)
                            <tr>
                                <td>{{ $item['event_name'] }}</td>
                                <td>{{ $item['ticket_type'] }}</td>
                                <td>${{ number_format($item['price'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="update-cart-form">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group input-group-sm" style="width: 120px;">
                                            <input type="number" name="quantity" class="form-control" 
                                                   value="{{ $item['quantity'] }}" min="1" max="{{ $item['max_available'] }}">
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Remove this item from cart?')">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total:</strong></td>
                            <td colspan="2"><strong>${{ number_format($total, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('events.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Continue Shopping
                </a>
                <a href="{{ route('cart.checkout') }}" class="btn btn-success">
                    Proceed to Checkout <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.update-cart-form').on('submit', function(e) {
        var quantity = $(this).find('input[name="quantity"]').val();
        var max = $(this).find('input[name="quantity"]').attr('max');
        
        if (parseInt(quantity) < 1 || parseInt(quantity) > parseInt(max)) {
            e.preventDefault();
            alert('Please enter a valid quantity between 1 and ' + max);
        }
    });
});
</script>
@endpush