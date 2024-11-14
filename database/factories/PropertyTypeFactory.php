<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PropertyType;

class PropertyTypeFactory extends Factory
{
    protected $model = PropertyType::class;

    public function definition()
    {
        return [
            'venues_id' => \App\Models\Venue::factory(), // Assuming there's a foreign key to Venue
            'propertytypelists_id' => \App\Models\PropertyTypeList::factory(), // Foreign key to PropertyTypeList
        ];
    }
}
