<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Show upcoming + ongoing events on the homepage
        // completed/cancelled are excluded — they shouldn't be featured
        $upcomingEvents = Event::with('tickets')
            ->whereIn('status', ['upcoming', 'ongoing'])
            ->orderByRaw("FIELD(status, 'ongoing', 'upcoming')")
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->take(7)                   // 1 featured card + 6 grid cards
            ->get();

        return view('home', compact('upcomingEvents'));
    }
}