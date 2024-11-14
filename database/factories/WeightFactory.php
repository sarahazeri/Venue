<?php

namespace Database\Factories;

use App\Models\VenueTypeList;
use App\Models\Weight;
use App\Models\Venue;
use App\Models\EventList;
use App\Models\PropertyTypeList;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Weight::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // انتخاب یک venue_id تصادفی از جدول venues
            'venues_id' => Venue::inRandomOrder()->first()->id,

            // انتخاب category_type به صورت تصادفی از یک لیست
            'category_type' => $this->faker->randomElement(['events', 'propertytypes', 'venuetypes']),

            // انتخاب category_id با توجه به category_type
            'category_id' => $this->faker->randomElement(
                $this->getCategoryIds($this->faker->randomElement(['events', 'propertytypes', 'venuetypes']))
            ),

            // انتخاب وزن تصادفی
            'weight' => $this->faker->numberBetween(1, 100), // وزن تصادفی بین 1 و 100
        ];
    }

    /**
     * دریافت شناسه‌های تصادفی بر اساس category_type
     *
     * @param string $categoryType
     * @return array
     */
    private function getCategoryIds($categoryType)
    {
        switch ($categoryType) {
            case 'events':
                return EventList::pluck('id')->toArray(); // شناسه‌های event از جدول eventLists
            case 'propertytypes':
                return PropertyTypeList::pluck('id')->toArray(); // شناسه‌های property_type از جدول propertytypelists
            case 'venuetypes':
                return VenueTypeList::pluck('id')->toArray(); // شناسه‌های venue_type از جدول venuetypelists
            default:
                return [];
        }
    }
}

