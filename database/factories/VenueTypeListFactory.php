<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\VenueTypeList;

class VenueTypeListFactory extends Factory
{
    protected $model = VenueTypeList::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word, // Example venue type name
            'filter' => $this->faker->numberBetween(0, 1), // Example filter
        ];
    }
}
