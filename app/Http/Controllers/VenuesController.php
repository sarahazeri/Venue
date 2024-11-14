<?php

namespace App\Http\Controllers;

use App\Models\EventList;
use App\Models\PropertyTypeList;
use App\Models\Venue;
use App\Models\VenueTypeList;
use App\Repositories\VenuesRepository;
use Illuminate\Http\Request;

class VenuesController extends Controller
{
    protected $venuesRepository;

    public function __construct(VenuesRepository $venuesRepository)
    {
        $this->venuesRepository = $venuesRepository;
    }

    public function index()
    {
        // Fetch all venues using the default sorting method
        $venues = $this->venuesRepository->getAllVenues();
        return view('venues.index', compact('venues'));
    }

    public function showFilterPage()
    {
        // Get categories with their respective IDs for the first dropdown
        $categories = [
            'venuetypes' => \App\Models\VenueTypeList::all(['id', 'name']),
            'propertytypes' => \App\Models\PropertyTypeList::all(['id', 'name']),
            'events' => \App\Models\EventList::all(['id', 'name']),
        ];
        $venues = $this->venuesRepository->getAllVenues();
        return view('venues.filtered', compact('venues', 'categories'));
    }

    public function filterByEventType(Request $request)
    {
        $request->validate([
            'category' => 'required|string|in:venuetypes,propertytypes,events',
            'categoryId' => 'required|integer',
        ]);

        $category = $request->input('category');
        $categoryId = $request->input('categoryId');

        // Fetch venues based on selected category and categoryId
        $venues = Venue::whereHas($category, function ($query) use ($categoryId) {
            $query->where('id', $categoryId);
        })->get();
        return view('venues.filtered', compact('venues', 'category', 'categoryId'));
    }

    public function getCategoryIds($category)
    {
        switch ($category) {
            case 'events':
                $items = EventList::select('id', 'name')->get();
                break;

            case 'propertytypes':
                $items = PropertyTypeList::select('id', 'name')->get();
                break;

            case 'venuetypes':
                $items = VenueTypeList::select('id', 'name')->get();
                break;

            default:
                return response()->json(['error' => 'Invalid category'], 400);
        }

        return response()->json($items);
    }

    public function filterVenues(Request $request)
    {
        $category = $request->category;
        $categoryId = $request->categoryId;

        // مرتب‌سازی venues بر اساس وزن
        $venuesResult = $this->venuesRepository->getVenuesByEventType($category, $categoryId);

        $venues = "";
        if (isset($venuesResult) && $venuesResult->count() > 0) {
            $venues .= '<div class="mt-4" >
                <h2 > Filtered Venues list</h2 >
                <ul class="list-group" >';
            foreach ($venuesResult as $venue) {
                $venues .= '<li class="list-group-item" >' . $venue->title . '</li >';
            }
            $venues .= '</ul >';
        } else {
            $venues .= '<div class="mt-4" >
                    <p > No venues found for the selected filters .</p >
                </div >';
        }
        return response()->json([
            'venues' => $venues
        ]);
    }
}

