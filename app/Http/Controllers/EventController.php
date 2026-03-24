<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        // Exclude cancelled and completed events — they should not appear in the listing
        $query = Event::with('tickets')
            ->whereNotIn('status', ['cancelled', 'completed']);

        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Sort
        $sort = $request->get('sort', 'date_asc');

        if (in_array($sort, ['price_asc', 'price_desc'])) {
            $dir = $sort === 'price_asc' ? 'asc' : 'desc';
            $query->leftJoin('tickets', 'events.id', '=', 'tickets.event_id')
                  ->select('events.*')
                  ->groupBy('events.id')
                  ->orderByRaw("MIN(tickets.price) {$dir}");
        } else {
            $sortMap = [
                'date_asc'   => ['date', 'asc'],
                'date_desc'  => ['date', 'desc'],
                'name_asc'   => ['name', 'asc'],
                'name_desc'  => ['name', 'desc'],
            ];
            [$col, $dir] = $sortMap[$sort] ?? ['date', 'asc'];

            // ongoing events always float to the top, then sorted by chosen column
            $query->orderByRaw("FIELD(status, 'ongoing', 'upcoming')")->orderBy($col, $dir);
        }

        $events = $query->paginate(9)->withQueryString();

        // Hide tickets for completed/cancelled events
        $events->each(function ($event) {
            if ($event->is_expired) {
                $event->setRelation('tickets', collect());
            }
        });

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        // Hide cancelled and completed events entirely
        if (in_array($event->status, ['cancelled', 'completed'])) {
            abort(404);
        }

        $event->load('tickets');

        return view('events.show', compact('event'));
    }

    /**
     * Lightweight JSON endpoint for real-time polling.
     * Returns { id: status } for all visible events.
     */
    public function poll()
    {
        $events = Event::whereNotIn('status', ['cancelled', 'completed'])
            ->select('id', 'status')
            ->get()
            ->mapWithKeys(fn ($e) => [$e->id => $e->status]);

        return response()->json($events);
    }
}