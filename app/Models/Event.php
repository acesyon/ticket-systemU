<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $primaryKey = 'eventID';
    
    protected $fillable = [
        'event_name',
        'description',
        'location',
        'eventDate',
        'eventTime',
        'status',
        'created_by'
    ];

    protected $casts = [
        'eventDate' => 'date',
        'eventTime' => 'datetime'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'eventID');
    }
}