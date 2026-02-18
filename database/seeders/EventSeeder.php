<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run()
    {
        // Create admin user if not exists
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ]
        );

        // Sample events
        $events = [
            [
                'event_name' => 'Music Festival 2026',
                'description' => 'Annual music festival featuring top artists from around the world. Experience three days of amazing performances, food, and fun.',
                'location' => 'Central Park, New York',
                'eventDate' => '2026-06-15',
                'eventTime' => '14:00:00',
                'status' => 'upcoming',
                'tickets' => [
                    ['ticketType' => 'VIP', 'price' => 299.99, 'quantity_available' => 100],
                    ['ticketType' => 'Regular', 'price' => 149.99, 'quantity_available' => 500],
                    ['ticketType' => 'Early Bird', 'price' => 99.99, 'quantity_available' => 200],
                ]
            ],
            [
                'event_name' => 'Tech Conference 2026',
                'description' => 'The biggest tech conference of the year. Learn about AI, blockchain, and future technologies from industry leaders.',
                'location' => 'Convention Center, San Francisco',
                'eventDate' => '2026-07-20',
                'eventTime' => '09:00:00',
                'status' => 'upcoming',
                'tickets' => [
                    ['ticketType' => 'VIP', 'price' => 599.99, 'quantity_available' => 50],
                    ['ticketType' => 'Regular', 'price' => 299.99, 'quantity_available' => 300],
                    ['ticketType' => 'Student', 'price' => 149.99, 'quantity_available' => 100],
                ]
            ],
            [
                'event_name' => 'Food & Wine Expo',
                'description' => 'Taste the finest cuisines and wines from top chefs and wineries. Cooking demonstrations and tasting sessions included.',
                'location' => 'Exhibition Center, Chicago',
                'eventDate' => '2026-08-10',
                'eventTime' => '11:00:00',
                'status' => 'upcoming',
                'tickets' => [
                    ['ticketType' => 'VIP', 'price' => 199.99, 'quantity_available' => 75],
                    ['ticketType' => 'Regular', 'price' => 89.99, 'quantity_available' => 400],
                    ['ticketType' => 'Early Bird', 'price' => 69.99, 'quantity_available' => 150],
                ]
            ],
        ];

        foreach ($events as $eventData) {
            $tickets = $eventData['tickets'];
            unset($eventData['tickets']);
            
            $eventData['created_by'] = $admin->id;
            
            $event = Event::create($eventData);
            
            foreach ($tickets as $ticketData) {
                $ticketData['eventID'] = $event->eventID;
                Ticket::create($ticketData);
            }
        }
    }
}