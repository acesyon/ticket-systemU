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
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Admin User',
                'password' => bcrypt('password'),
                'role'     => 'admin',
            ]
        );

        $events = [
            [
                'name'        => 'Music Festival 2026',
                'category'    => 'Concert / Music',
                'description' => 'Annual music festival featuring top artists from around the world. Experience three days of amazing performances, food, and fun.',
                'location'    => 'Central Park, New York',
                'date'        => '2026-06-15',
                'time'        => '14:00:00',
                'status'      => 'upcoming',
                'tickets'     => [
                    ['ticket_type' => 'VIP',        'price' => 299.99, 'quantity_available' => 100],
                    ['ticket_type' => 'Regular',    'price' => 149.99, 'quantity_available' => 500],
                    ['ticket_type' => 'Early Bird', 'price' =>  99.99, 'quantity_available' => 200],
                ],
            ],
            [
                'name'        => 'Tech Conference 2026',
                'category'    => 'Conference / Seminar',
                'description' => 'The biggest tech conference of the year. Learn about AI, blockchain, and future technologies from industry leaders.',
                'location'    => 'Convention Center, San Francisco',
                'date'        => '2026-07-20',
                'time'        => '09:00:00',
                'status'      => 'upcoming',
                'tickets'     => [
                    ['ticket_type' => 'VIP',     'price' => 599.99, 'quantity_available' =>  50],
                    ['ticket_type' => 'Regular', 'price' => 299.99, 'quantity_available' => 300],
                    ['ticket_type' => 'Student', 'price' => 149.99, 'quantity_available' => 100],
                ],
            ],
            [
                'name'        => 'Food & Wine Expo',
                'category'    => 'Food & Drinks',
                'description' => 'Taste the finest cuisines and wines from top chefs and wineries. Cooking demonstrations and tasting sessions included.',
                'location'    => 'Exhibition Center, Chicago',
                'date'        => '2026-08-10',
                'time'        => '11:00:00',
                'status'      => 'upcoming',
                'tickets'     => [
                    ['ticket_type' => 'VIP',        'price' => 199.99, 'quantity_available' =>  75],
                    ['ticket_type' => 'Regular',    'price' =>  89.99, 'quantity_available' => 400],
                    ['ticket_type' => 'Early Bird', 'price' =>  69.99, 'quantity_available' => 150],
                ],
            ],
            [
                'name'        => 'Comedy Night Live',
                'category'    => 'Comedy / Show',
                'description' => 'A hilarious night with the country\'s top stand-up comedians. Guaranteed laughs for the whole evening.',
                'location'    => 'Laugh Factory, Los Angeles',
                'date'        => '2026-09-05',
                'time'        => '20:00:00',
                'status'      => 'upcoming',
                'tickets'     => [
                    ['ticket_type' => 'Front Row', 'price' => 129.99, 'quantity_available' =>  40],
                    ['ticket_type' => 'Regular',   'price' =>  59.99, 'quantity_available' => 200],
                ],
            ],
            [
                'name'        => 'Summer Sports Festival',
                'category'    => 'Sports',
                'description' => 'Compete or watch in a variety of sports events including basketball, volleyball, and track & field.',
                'location'    => 'Sports Complex, Miami',
                'date'        => '2026-07-04',
                'time'        => '08:00:00',
                'status'      => 'upcoming',
                'tickets'     => [
                    ['ticket_type' => 'Competitor Pass', 'price' =>  49.99, 'quantity_available' => 300],
                    ['ticket_type' => 'Spectator',       'price' =>  19.99, 'quantity_available' => 800],
                ],
            ],
            [
                'name'        => 'Theater Arts Gala',
                'category'    => 'Theater / Arts',
                'description' => 'An evening celebrating the best in theater, dance, and visual arts. Live performances and gallery showcases.',
                'location'    => 'Grand Theater, Boston',
                'date'        => '2026-10-18',
                'time'        => '19:00:00',
                'status'      => 'upcoming',
                'tickets'     => [
                    ['ticket_type' => 'Premium',  'price' => 179.99, 'quantity_available' =>  60],
                    ['ticket_type' => 'Standard', 'price' =>  79.99, 'quantity_available' => 250],
                ],
            ],
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
