<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Ticket $ticket)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $ticket->quantity_available
        ]);

        $cart = session()->get('cart', []);
        $ticketId = (string) $ticket->id;

        if (isset($cart[$ticketId])) {
            $newQuantity = $cart[$ticketId]['quantity'] + $request->quantity;
            if ($newQuantity > $ticket->quantity_available) {
                return redirect()->route('cart.index')
                    ->with('error', 'Not enough tickets available.');
            }
            $cart[$ticketId]['quantity'] = $newQuantity;
        } else {
            $cart[$ticketId] = [
                'ticket_id'     => $ticketId,
                'event_name'    => $ticket->event->name,
                'ticket_type'   => $ticket->ticket_type,
                'price'         => $ticket->price,
                'quantity'      => $request->quantity,
                'max_available' => $ticket->quantity_available,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Ticket added to cart!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $id = (string) $id;

        if (!isset($cart[$id])) {
            return redirect()->route('cart.index')->with('error', 'Item not found in cart.');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cart[$id]['max_available']
        ]);

        $cart[$id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        $id = (string) $id;

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.checkout', compact('cart', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,gcash,credit_card,paypal'
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        DB::beginTransaction();

        try {
            $lastOrder = null;

            foreach ($cart as $item) {
                $ticket = Ticket::findOrFail($item['ticket_id']);

                // Check availability
                if ($ticket->quantity_available < $item['quantity']) {
                    throw new \Exception("Not enough tickets available for {$ticket->event->name}");
                }

                // Create order
                $order = Order::create([
                    'user_id'   => auth()->id(),
                    'ticket_id' => $ticket->id,
                    'quantity'  => $item['quantity'],
                    'status'    => 'completed',
                ]);

                // Create payment
                Payment::create([
                    'order_id'       => $order->id,
                    'payment_method' => $request->payment_method,
                    'amount'         => $item['price'] * $item['quantity'],
                    'status'         => 'completed',
                ]);

                // Decrease ticket availability
                $ticket->decrement('quantity_available', $item['quantity']);

                $lastOrder = $order;
            }

            session()->forget('cart');

            DB::commit();

            return redirect()->route('cart.success', ['order' => $lastOrder->id])
                ->with('success', 'Payment successful!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('ticket.event', 'payment');

        return view('cart.success', compact('order'));
    }
}
