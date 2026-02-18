<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'orderID';
    
    protected $fillable = [
        'userID',
        'ticketID',
        'quantity',
        'date_purchased',
        'status'
    ];

    protected $casts = [
        'date_purchased' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticketID');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'orderID');
    }

    public function getTotalAmountAttribute()
    {
        return $this->quantity * $this->ticket->price;
    }
}