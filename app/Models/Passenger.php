<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'first_name', 'last_name', 'birth_date', 'document_number'];

    public function getPlaceBackAttribute($place_back)
    {
        if (is_null($place_back)) return [];

        return $place_back;
    }
}
