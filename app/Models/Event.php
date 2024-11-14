<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venues_id', 'id'); // venues_id به عنوان کلید خارجی
    }
}
