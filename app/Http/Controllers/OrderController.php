<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
