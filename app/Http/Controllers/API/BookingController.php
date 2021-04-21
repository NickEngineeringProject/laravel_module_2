<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    //создаем бронирование потом пассажира
    public function set(Request $request): \Illuminate\Http\JsonResponse
    {
        $code = Str::random(5);
        $codeUpper = Str::upper($code);

        $data = $request->all();
//        dd($data);

        $bookings = Booking::create([
            'flight_from' => $data['flight_from']['id'],
            'flight_back' => $data['flight_back']['id'],
            'date_from' => $data['flight_from']['date'],
            'date_back' => $data['flight_back']['date'],
            'code' => $codeUpper,
        ]);

        foreach($data['passengers'] as $passenger) {
            Passenger::create([
                'booking_id' => $bookings->id,
                'first_name' => $passenger['first_name'],
                'last_name' => $passenger['last_name'],
                'birth_date' => $passenger['birth_date'],
                'document_number' => $passenger['document_number'],
            ]);
        }

        return Response::json($codeUpper, 201);
    }

    public function get(Request $request): \Illuminate\Http\JsonResponse
    {
        $requestCode = $request->route('code');

        $bookingCode = Booking::where('code', $requestCode)->first();

        return Response::json($bookingCode, 200);
    }

    public function getSeat(Request $request): \Illuminate\Http\JsonResponse
    {
        $requestCode = $request->route('code');

        $booking = Booking::where('code', $requestCode)
            ->first()
            ->value('id');

        $passenger = Passenger::where('booking_id', $booking)->get(['id', 'place_from', 'place_back']);

        return Response::json($passenger, 200);
    }

    public function patchSeat(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->input('passenger');

        $seat = $request->input('seat');

        $type = $request->input('type');

        $type == 'from' ? $fromBack = $seat : null;

        Passenger::where('id', $id)->update([
            'place_from' => $fromBack
        ]);

        $passenger = Passenger::where('id', $id)->first();

        return Response::json($passenger,200);
    }
}
