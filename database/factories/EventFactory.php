<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'venues_id' => \App\Models\Venue::factory(), // Foreign key to Venue
            'eventlists_id' => \App\Models\EventList::factory(), // Foreign key to EventList
        ];
    }
}
