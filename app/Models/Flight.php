<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    public function from()
    {
        return $this->belongsTo(Airport::class, 'from_id');
    }

    public function to()
    {
        return $this->belongsTo(Airport::class, 'to_id');
    }
}
