<?php


namespace App\Repositories;

use App\Models\Venue;
use App\Models\Weight;
use Illuminate\Support\Facades\Cache;

class VenuesRepository
{
    public function getAllVenues()
    {
        // Fetch all venues based on the default sorting (sortid)
        return Venue::orderBy('sortid')->get();
    }

    public function getVenuesByEventType($category, $categoryId)
    {
        $venues = Cache::remember('venues_by_category_' . $category . '_' . $categoryId, now()->addMinutes(10), function () use ($category, $categoryId) {
            return Venue::join('weights', function ($join) use ($category, $categoryId) {
                $join->on('venues.id', '=', 'weights.venues_id')
                    ->where('weights.category_type', '=', $category)
                    ->where('weights.category_id', '=', $categoryId);
            })
                ->select('venues.*', 'weights.weight')
                ->orderByDesc('weights.weight')
                ->get();
        });


        return $venues;
    }


}
