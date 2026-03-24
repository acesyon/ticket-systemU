<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'ticket_id',
        'quantity',
        'total_price',      // Add this - it's REQUIRED in your database
        'status',
        'date_purchased'
    ];

    // Optional: Add casts for proper data type handling
    protected $casts = [
        'date_purchased' => 'datetime',
        'total_price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}