<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventList;
use App\Models\PropertyType;
use App\Models\PropertyTypeList;
use App\Models\VenueType;
use App\Models\VenueTypeList;
use App\Models\Weight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Venue;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Venue::factory(30)->create();
        VenueType::factory()->count(30)->create();
        PropertyType::factory()->count(30)->create();
        Event::factory()->count(30)->create();
        EventList::factory()->count(5)->create();
        PropertyTypeList::factory()->count(5)->create();
        VenueTypeList::factory()->count(5)->create();
        Weight::factory()->count(300)->create();
        $password = bcrypt('123');
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'remember_token' => Str::random(10),
        ]);
    }
}
