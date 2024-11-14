<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $table = 'venues';
    protected $fillable = [
        'title',
        'address',
    ];

    // Define relationships
    public function propertyTypes()
    {
        return $this->belongsTo(PropertyType::class, 'id', 'venues_id');
    }

    public function venueTypes()
    {
        return $this->belongsTo(VenueType::class, 'id', 'venues_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'venues_id', 'id'); // استفاده از venues_id به عنوان کلید خارجی
    }
}
