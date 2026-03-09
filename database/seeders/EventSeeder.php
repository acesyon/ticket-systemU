<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        // Admin account
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'first_name' => 'Admin',
                'middle_name' => 'T',
                'last_name' => 'User',
                'contact_no' => '09123456789',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        $events = [
            [
                'name' => 'Music Festival 2026',
                'category' => 'Concert / Music',
                'description' => 'Annual music festival with top artists.',
                'location' => 'Mall of Asia Arena, Manila',
                'date' => '2026-06-15',
                'time' => '14:00:00',
                'status' => 'upcoming',
                'tickets' => [
                    ['ticket_type'=>'VIP', 'price'=>299.99, 'quantity_available'=>100],
                    ['ticket_type'=>'Regular', 'price'=>149.99, 'quantity_available'=>500],
                    ['ticket_type'=>'Early Bird', 'price'=>99.99, 'quantity_available'=>200],
                ],
            ],
            [
                'name' => 'Tech Conference 2026',
                'category' => 'Conference / Seminar',
                'description' => 'Learn about AI, blockchain, and future technologies.',
                'location' => 'SMX Convention Center, Manila',
                'date' => '2026-07-20',
                'time' => '09:00:00',
                'status' => 'upcoming',
                'tickets' => [
                    ['ticket_type'=>'VIP', 'price'=>599.99, 'quantity_available'=>50],
                    ['ticket_type'=>'Regular', 'price'=>299.99, 'quantity_available'=>300],
                    ['ticket_type'=>'Student', 'price'=>149.99, 'quantity_available'=>100],
                ],
            ],
            // Add more events similarly...
        ];

        foreach ($events as $eventData) {
            $tickets = $eventData['tickets'];
            unset($eventData['tickets']);

            $eventData['created_by'] = $admin->id;

            $event = Event::create($eventData);

            foreach ($tickets as $ticketData) {
                $ticketData['event_id'] = $event->id;
                Ticket::create($ticketData);
            }
        }
    }
}