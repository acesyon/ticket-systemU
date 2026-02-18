<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ticket #{{ $order->orderID }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .ticket {
            border: 2px solid #333;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            border-bottom: 2px dashed #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .event-details {
            margin-bottom: 20px;
        }
        .event-details h2 {
            margin: 0 0 10px 0;
            color: #0066cc;
        }
        .info-row {
            margin-bottom: 5px;
        }
        .info-label {
            font-weight: bold;
            display: inline-block;
            width: 120px;
        }
        .qr-code {
            text-align: center;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
        }
        .status {
            display: inline-block;
            padding: 5px 10px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">
            <h1>EVENT TICKET</h1>
            <p>Order #{{ $order->orderID }}</p>
        </div>
        
        <div class="event-details">
            <h2>{{ $order->ticket->event->event_name }}</h2>
            
            <table>
                <tr>
                    <td class="info-label">Date:</td>
                    <td>{{ \Carbon\Carbon::parse($order->ticket->event->eventDate)->format('F d, Y') }}</td>
                </tr>
                <tr>
                    <td class="info-label">Time:</td>
                    <td>{{ \Carbon\Carbon::parse($order->ticket->event->eventTime)->format('h:i A') }}</td>
                </tr>
                <tr>
                    <td class="info-label">Location:</td>
                    <td>{{ $order->ticket->event->location }}</td>
                </tr>
                <tr>
                    <td class="info-label">Ticket Type:</td>
                    <td>{{ $order->ticket->ticketType }}</td>
                </tr>
                <tr>
                    <td class="info-label">Quantity:</td>
                    <td>{{ $order->quantity }}</td>
                </tr>
                <tr>
                    <td class="info-label">Price:</td>
                    <td>${{ number_format($order->ticket->price, 2) }}</td>
                </tr>
                <tr>
                    <td class="info-label">Total:</td>
                    <td><strong>${{ number_format($order->payment->payment, 2) }}</strong></td>
                </tr>
                <tr>
                    <td class="info-label">Status:</td>
                    <td><span class="status">CONFIRMED</span></td>
                </tr>
                <tr>
                    <td class="info-label">Purchased by:</td>
                    <td>{{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                </tr>
                <tr>
                    <td class="info-label">Email:</td>
                    <td>{{ $order->user->email }}</td>
                </tr>
            </table>
        </div>
        
        <div class="qr-code">
            <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code">
            <p>Scan this QR code at the entrance</p>
        </div>
        
        <div class="footer">
            <p>This is your official ticket. Please present this at the event entrance.</p>
            <p>For any questions, please contact our support team.</p>
        </div>
    </div>
</body>
</html>