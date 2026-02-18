<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('tickets')
            ->where('status', 'upcoming')
            ->where('eventDate', '>=', now())
            ->orderBy('eventDate')
            ->paginate(9);
            
        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load('tickets');
        return view('events.show', compact('event'));
    }

    public function search(Request $request)
    {
        $query = Event::query()->where('status', 'upcoming');
        
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('event_name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        
        $events = $query->orderBy('eventDate')->paginate(9);
        
        return view('events.index', compact('events'));
    }
}