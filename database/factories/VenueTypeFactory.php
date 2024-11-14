<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\VenueType;

class VenueTypeFactory extends Factory
{
    protected $model = VenueType::class;

    public function definition()
    {
        return [
            'venues_id' => \App\Models\Venue::factory(), // Assuming there's a foreign key to Venue
            'venuetypelists_id' => \App\Models\VenueTypeList::factory(), // Foreign key to VenueTypeList
        ];
    }
}
