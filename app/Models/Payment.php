<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'paymentID';
    
    protected $fillable = [
        'orderID',
        'payment_method',
        'payment',
        'date_paid'
    ];

    protected $casts = [
        'date_paid' => 'datetime'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderID');
    }
}