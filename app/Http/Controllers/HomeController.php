<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index()
{
    $upcomingEvents = Event::with('tickets')
        ->where('status', 'upcoming')
        ->whereDate('date', '>=', now())
        ->orderBy('date')
        ->take(6)
        ->get();

    return view('home', compact('upcomingEvents'));
}

}
