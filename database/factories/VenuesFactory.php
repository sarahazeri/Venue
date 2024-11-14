<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Venues;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VenuesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Venues::class;
    private static $sortValue = 1;

    public function definition()
    {
        return [
            //
            'title' => $this->faker->name(mt_rand(2, 10)),
            'address' => $this->faker->address(),
            'sortid' => self::$sortValue++,

        ];
    }
}