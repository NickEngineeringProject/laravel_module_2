<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = ['city', 'name', 'iata'];

    public function from()
    {
        return $this->hasOne(Flight::class, 'id');
    }

    public function to()
    {
        return $this->hasOne(Flight::class, 'id');
    }
}
