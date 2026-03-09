<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('tickets')->where('status', '!=', 'cancelled');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $sortMap = [
            'date_asc'   => ['date', 'asc'],
            'date_desc'  => ['date', 'desc'],
            'name_asc'   => ['name', 'asc'],
            'name_desc'  => ['name', 'desc'],
        ];

        [$col, $dir] = $sortMap[$request->sort] ?? ['date', 'asc'];

        $events = $query->orderBy($col, $dir)->paginate(9)->withQueryString();

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        if ($event->status === 'cancelled') {
            abort(404);
        }

        $event->load('tickets');

        return view('events.show', compact('event'));
    }

    // Redirects to index with search param — keeps the search route working
    public function search(Request $request)
    {
        return redirect()->route('events.index', [
            'search' => $request->input('search'),
        ]);
    }
}
