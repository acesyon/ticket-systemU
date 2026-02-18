@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4">Shopping Cart</h1>

        {{-- Success / Error Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(empty($cart))
            <div class="alert alert-info text-center py-5">
                <i class="fas fa-shopping-cart fa-3x mb-3 d-block"></i>
                <p class="mb-3">Your cart is empty.</p>
                <a href="{{ route('events.index') }}" class="btn btn-primary">
                    Browse Events
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
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
                                    <form action="{{ route('cart.update', $item['ticket_id']) }}" method="POST" class="update-cart-form">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group input-group-sm" style="width: 130px;">
                                            <input type="number"
                                                   name="quantity"
                                                   class="form-control"
                                                   value="{{ $item['quantity'] }}"
                                                   min="1"
                                                   max="{{ $item['max_available'] }}">
                                            <button type="submit" class="btn btn-outline-primary" title="Update">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $item['ticket_id']) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
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
                            <td colspan="4" class="text-end fw-bold">Total:</td>
                            <td colspan="2" class="fw-bold">${{ number_format($total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-3">
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
$(document).ready(function () {
    $('.update-cart-form').on('submit', function (e) {
        const input = $(this).find('input[name="quantity"]');
        const quantity = parseInt(input.val());
        const max = parseInt(input.attr('max'));
        const min = parseInt(input.attr('min'));

        if (isNaN(quantity) || quantity < min || quantity > max) {
            e.preventDefault();
            alert('Please enter a valid quantity between ' + min + ' and ' + max + '.');
            input.focus();
        }
    });
});
</script>
@endpush
