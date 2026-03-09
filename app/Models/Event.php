<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'category',
        'description',
        'location',
        'date',
        'time',
        'status',
        'created_by'
    ];

    // Category config — icon, color, emoji
    public static function categories(): array
    {
        return [
            'Concert / Music'      => ['icon' => 'bi-music-note-beamed', 'color' => '#e94560'],
            'Sports'               => ['icon' => 'bi-trophy',            'color' => '#f59e0b'],
            'Food & Drinks'        => ['icon' => 'bi-cup-straw',         'color' => '#10b981'],
            'Comedy / Show'        => ['icon' => 'bi-emoji-laughing',    'color' => '#8b5cf6'],
            'Conference / Seminar' => ['icon' => 'bi-person-workspace',  'color' => '#3b82f6'],
            'Festival'             => ['icon' => 'bi-stars',             'color' => '#ec4899'],
            'Theater / Arts'       => ['icon' => 'bi-mask',              'color' => '#f97316'],
        ];
    }

    public function getCategoryColorAttribute(): string
    {
        return self::categories()[$this->category]['color'] ?? '#e94560';
    }

    public function getCategoryEmojiAttribute(): string
    {
        return self::categories()[$this->category]['emoji'] ?? '🎪';
    }

    public function getCategoryIconAttribute(): string
    {
        return self::categories()[$this->category]['icon'] ?? 'bi-calendar-event';
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'event_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
