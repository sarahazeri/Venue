<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;

    // نام جدول مرتبط با مدل (در صورت نیاز می‌توانید آن را تغییر دهید)
    public $timestamps = false;

    // ستون‌هایی که می‌خواهید از آنها در عملیات‌هایی مثل insert یا update استفاده کنید
    protected $table = 'weights';

    // اگر از timestamp ها استفاده نمی‌کنید (در صورتیکه ستون‌های created_at و updated_at را نداشته باشید)
    protected $fillable = [
        'venues_id',
        'category_type',
        'category_id',
        'weight'
    ];

    // روابط مدل با دیگر مدل‌ها

    /**
     * ارتباط با مدل Venue
     */
    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venues_id');
    }

    /**
     * ارتباط با مدل EventList
     */
    public function event()
    {
        return $this->belongsTo(EventList::class, 'category_id');
    }

    /**
     * ارتباط با مدل PropertyTypeList
     */
    public function propertyType()
    {
        return $this->belongsTo(PropertyTypeList::class, 'category_id');
    }

    /**
     * ارتباط با مدل VenueTypeList
     */
    public function venueType()
    {
        return $this->belongsTo(VenueTypeList::class, 'category_id');
    }
}
