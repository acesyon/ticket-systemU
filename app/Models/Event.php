<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'location',
        'date',
        'time',
        'status',
        'created_by',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
