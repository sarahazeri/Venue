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
    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function venueType()
    {
        return $this->belongsTo(VenueType::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
