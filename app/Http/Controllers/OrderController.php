<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ticket;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['ticket.event', 'payment'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ticket_id'      => 'required|exists:tickets,id',
            'quantity'       => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,gcash,paypal,credit_card',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);

        // Check if enough tickets are available
        if ($ticket->quantity_available < $request->quantity) {
            return back()->withErrors(['quantity' => 'Not enough tickets available.']);
        }

        $totalAmount = $ticket->price * $request->quantity;

        // Create the order
        $order = Order::create([
            'user_id'        => auth()->id(),
            'ticket_id'      => $ticket->id,
            'quantity'       => $request->quantity,
            'status'         => 'completed',
            'date_purchased' => now(),
        ]);

        // Create payment with date_paid stamped
        Payment::create([
            'order_id'       => $order->id,
            'amount'         => $totalAmount,
            'payment_method' => $request->payment_method,
            'status'         => 'completed',
            'date_paid'      => now(),
        ]);

        // Deduct from available tickets
        $ticket->decrement('quantity_available', $request->quantity);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed successfully!');
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('ticket.event', 'payment');

        return view('orders.show', compact('order'));
    }

    public function download(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->status !== 'completed') {
            return redirect()->route('orders.show', $order)
                ->with('error', 'Ticket is only available for completed orders.');
        }

        $order->load('ticket.event', 'payment', 'user');

        return view('orders.download', compact('order'));
    }
}