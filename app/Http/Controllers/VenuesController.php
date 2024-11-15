<?php

namespace App\Http\Controllers;

use App\Repositories\VenuesRepository;
use Illuminate\Http\Request;
use App\Support\CategoryList;

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
        $categories = CategoryList::all();
        $venues = $this->venuesRepository->getAllVenues();

        return view('venues.filtered', compact('venues', 'categories'));
    }

    //Now the filtering is being applied as Ajax. If you want to exit the Ajax mode, this method should be used
    public function filterByEventType(Request $request)
    {
        $categories = CategoryList::all();
        $categoryNames = $categories->pluck('name');
        $categoryList = $categoryNames->implode($key = ',');
        $request->validate([
            'category' => 'required|string|in:' . $categoryList,
            'categoryId' => 'required|integer',
        ]);

        $category = $request->input('category');
        $categoryId = $request->input('categoryId');

        // Fetch venues based on selected category and categoryId
        $venues = $this->venuesRepository->getVenuesByEventType($category, $categoryId);

        return view('venues.filtered', compact('venues', 'category', 'categoryId'));
    }

    public function getCategoryIds($category)
    {
        $category = CategoryList::findByName($category);
        $items = $category['model']::select('id', 'name')->get();
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

