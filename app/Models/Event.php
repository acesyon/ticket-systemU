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
        'created_by',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // ─── Category Config ─────────────────────────────────────────────────────────
    // Covers all categories currently in the DB, including loose ones like
    // 'Music', 'Tech', 'Arts & Culture', 'Business'.

    public static function categories(): array
    {
        return [
            // ── Primary categories ──
            'Concert / Music'      => ['icon' => 'bi-music-note-beamed', 'color' => '#e94560', 'emoji' => '🎵'],
            'Sports'               => ['icon' => 'bi-trophy',            'color' => '#f59e0b', 'emoji' => '🏆'],
            'Food & Drinks'        => ['icon' => 'bi-cup-straw',         'color' => '#10b981', 'emoji' => '🍹'],
            'Comedy / Show'        => ['icon' => 'bi-emoji-laughing',    'color' => '#8b5cf6', 'emoji' => '😂'],
            'Conference / Seminar' => ['icon' => 'bi-person-workspace',  'color' => '#3b82f6', 'emoji' => '💼'],
            'Festival'             => ['icon' => 'bi-stars',             'color' => '#ec4899', 'emoji' => '🎉'],
            'Theater / Arts'       => ['icon' => 'bi-mask',              'color' => '#f97316', 'emoji' => '🎭'],

            // ── Extra categories found in DB ──
            'Music'                => ['icon' => 'bi-music-note-beamed', 'color' => '#e94560', 'emoji' => '🎵'],
            'Tech'                 => ['icon' => 'bi-cpu',               'color' => '#06b6d4', 'emoji' => '💻'],
            'Arts & Culture'       => ['icon' => 'bi-palette',           'color' => '#f97316', 'emoji' => '🎨'],
            'Business'             => ['icon' => 'bi-briefcase',         'color' => '#64748b', 'emoji' => '💼'],
        ];
    }

    // ─── Live Status Accessor ────────────────────────────────────────────────────

    /**
     * Returns the status exactly as stored in the database.
     * The DB status column is the single source of truth —
     * admins set it manually (upcoming / ongoing / completed / cancelled).
     */
    public function getLiveStatusAttribute(): string
    {
        return $this->status;
    }

    /**
     * Whether tickets should be hidden (event is done or cancelled).
     */
    public function getIsExpiredAttribute(): bool
    {
        return in_array($this->status, ['completed', 'cancelled']);
    }

    // ─── Category Accessors ──────────────────────────────────────────────────────

    public function getCategoryColorAttribute(): string
    {
        return self::categories()[$this->category]['color'] ?? '#c9a84c';
    }

    public function getCategoryEmojiAttribute(): string
    {
        return self::categories()[$this->category]['emoji'] ?? '🎪';
    }

    public function getCategoryIconAttribute(): string
    {
        return self::categories()[$this->category]['icon'] ?? 'bi-calendar-event';
    }

    // ─── Date / Time Accessors ───────────────────────────────────────────────────

    /** "Mar 18, 2026" */
    public function getFormattedDateAttribute(): string
    {
        return $this->date ? $this->date->format('M d, Y') : '—';
    }

    /** "05:00 PM" */
    public function getFormattedTimeAttribute(): string
    {
        return $this->time ? date('h:i A', strtotime($this->time)) : '—';
    }

    // ─── Price Accessor ──────────────────────────────────────────────────────────

    /** Lowest ticket price, or null if no tickets exist */
    public function getMinPriceAttribute(): ?float
    {
        return $this->tickets->isNotEmpty()
            ? $this->tickets->min('price')
            : null;
    }

    // ─── Relationships ───────────────────────────────────────────────────────────

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'event_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}