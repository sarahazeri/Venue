<?php


namespace App\Repositories;

use App\Models\Venue;
use App\Models\Weight;

class VenuesRepository
{
    public function getAllVenues()
    {
        // Fetch all venues based on the default sorting (sortid)
        return Venue::orderBy('sortid')->get();
    }

    public function getVenuesByEventType($category, $categoryId)
    {
        // Fetch venues based on a specific event type with custom sorting by weight
        // دریافت وزن‌ها برای دسته‌بندی انتخاب‌شده
        $weights = Weight::where(['category_type' => $category, 'category_id' => $categoryId])
            ->get();
        // استخراج venue_ids از وزن‌ها
        $venueIds = $weights->pluck('venues_id'); // اینجا فرض می‌کنیم که فیلد venue_id در جدول weights است

        // دریافت venue ها با استفاده از venue_ids
        $venues = Venue::whereIn('id', $venueIds)->get();

        // حالا می‌توانید اقدام به مرتب‌سازی یا هر عملی روی نتایج کنید
        $venues = $venues->map(function ($venue) use ($weights) {
            // پیدا کردن وزن مرتبط با هر venue
            $venueWeight = $weights->firstWhere('venues_id', $venue->id);

            // اگر وزنی برای venue پیدا نشد، مقدار پیش‌فرض صفر قرار می‌دهیم
            $venue->weight = $venueWeight ? $venueWeight->weight : 0;

            return $venue;
        });

        return $venues->sortBy('weight');
    }
}
