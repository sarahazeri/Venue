<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EventList;

class EventListFactory extends Factory
{
    protected $model = EventList::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word, // Example event type name
            'filter' => $this->faker->numberBetween(0, 1), // Example filter
        ];
    }
}
