<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run()
    {
        Event::create([
            'name' => 'Conferência de Tecnologia',
            'description' => 'Uma conferência sobre as últimas inovações em tecnologia.',
            'location' => 'São Paulo, SP',
            'event_date' => '2024-11-20 09:00:00',
            'price' => 100.00,
            'image' => 'path/to/image.jpg',
        ]);

    }
}