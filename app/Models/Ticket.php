<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $primaryKey = 'ticketID';
    
    protected $fillable = [
        'eventID',
        'ticketType',
        'price',
        'quantity_available'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'eventID');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'ticketID');
    }
}