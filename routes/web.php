<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

// Home page
Route::get('/', [TicketController::class, 'home'])->name('home');

// Login routes
Route::get('/login', [TicketController::class, 'showLoginForm'])->name('login');
Route::post('/login', [TicketController::class, 'login'])->name('login.post');

// Register routes
Route::get('/register', [TicketController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [TicketController::class, 'register'])->name('register.post');