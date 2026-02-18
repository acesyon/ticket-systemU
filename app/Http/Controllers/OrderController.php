<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['ticket.event', 'payment'])
            ->where('userID', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->userID !== auth()->id()) {
            abort(403);
        }

        $order->load('ticket.event', 'payment');
        
        return view('orders.show', compact('order'));
    }

    public function download(Order $order)
    {
        if ($order->userID !== auth()->id()) {
            abort(403);
        }

        $order->load('ticket.event', 'payment');
        
        // Generate QR Code
        $qrCode = base64_encode(QrCode::format('svg')->size(100)->generate($order->orderID));
        
        $pdf = Pdf::loadView('orders.ticket-pdf', compact('order', 'qrCode'));
        
        return $pdf->download('ticket-' . $order->orderID . '.pdf');
    }
}