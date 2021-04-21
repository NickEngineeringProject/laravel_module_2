<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\Booking;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class FlightController extends Controller
{
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $findAirportFrom = Airport::where('iata', $request->get('from'))
            ->first()
            ->only('id');

        $findAirportTo = Airport::where('iata', $request->get('to'))
            ->first()
            ->only('id');

        $flightFromTo = Flight::where('from_id', '=', $findAirportFrom)
            ->where('to_id', '=', $findAirportTo)
            ->with('from', 'to')
            ->get()
            ->map(function ($item) {
                $item->flight_id = $item->id;
                unset($item['id']);
                return $item;
            });

        $flightToFrom = Flight::where('to_id', '=', $findAirportFrom)
            ->where('from_id', '=', $findAirportTo)
            ->with('from', 'to')
            ->get();

        $isValidDateFrom = Booking::where('date_from', $request->get('date1'))
                ->first()
                ->value('date_from') ?? [];

        $isValidDateBack = Booking::where('date_back', $request->get('date2'))
            ->first();

        (is_null($isValidDateBack)) ? [] : $isValidDateBack = $isValidDateBack->value('date_back');

        $passengers = $request->get('passengers');

        return Response::json(
            [
                'flight_to' => [$flightFromTo, $isValidDateFrom, $isValidDateBack],
                'flight_back' => $flightToFrom
            ], 200);
    }
}
