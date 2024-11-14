<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PropertyTypeList;

class PropertyTypeListFactory extends Factory
{
    protected $model = PropertyTypeList::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word, // Example property type name
            'filter' => $this->faker->numberBetween(0, 1), // Example filter
        ];
    }
}
