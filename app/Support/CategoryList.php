<?php

namespace app\Support;

class CategoryList
{
    // تعریف دسته‌بندی‌ها
    protected static $categories = [
        ['id' => 1, 'name' => 'events', 'title' => 'Event Type', 'model' => 'App\Models\EventList'],
        ['id' => 2, 'name' => 'propertytypes', 'title' => 'Property Type', 'model' => 'App\Models\PropertyTypeList'],
        ['id' => 3, 'name' => 'venuetypes', 'title' => 'Venue Type', 'model' => 'App\Models\VenueTypeList'],
    ];

    // دریافت همه دسته‌بندی‌ها
    public static function all()
    {
        return collect(self::$categories);
    }

    // دریافت دسته‌بندی بر اساس ID
    public static function find($id)
    {
        return collect(self::$categories)->firstWhere('id', $id);
    }

    // دریافت دسته‌بندی بر اساس نام
    public static function findByName($name)
    {
        return collect(self::$categories)->firstWhere('name', $name);
    }

}
