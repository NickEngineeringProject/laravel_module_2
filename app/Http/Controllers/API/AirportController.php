<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->get('query');

        return Airport::where('city', 'like', "%$query%")
            ->orWhere('iata', 'like', "%$query%")
            ->orWhere('name', 'like', "%$query%")
            ->get();
    }
}
