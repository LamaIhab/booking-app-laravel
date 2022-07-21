<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Seat;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function getSeats(Request $request)
    {
        // checking first to see if user provided a correct token and is authenticated
        $user = Auth::user();
        if (!$user) return response()->json(["message" => "Unauthorized"], 401);
        // validate user input
        // using start and end point,get busses with their seats that are not booked and available seats not equal zero
    }

    public function bookSeat($id, Request $request)
    {
        // checking first to see if user provided a correct token and is authenticated
        $user = Auth::user();
        if (!$user) return response()->json(["message" => "Unauthorized"], 401);
        // validate user input of start and end points and that it's a valid city
        $validate = BookingRequest::validateBookingRequest($request->toArray());
        if ($validate) return $validate;
        // check to see if this seat exists
        $seat = Seat::find($id);
        if (!$seat) return response()->json(["message" => "There is no seat with id = " . $id], 404);
        // check to see if this seat is taken
        if ($seat->booked) return response()->json(["message" => "The seat with id " . $id . " is already booked"], 405);
        $busId = $seat->bus_id;
        // get trip that user will go on using start and end points
        $trip = Trip::where('bus_id', $busId)->where('start_point', $request->start_point)->where('end_point', $request->end_point)->first();
        if (!$trip) return response()->json(["message" => "There is no seat with id " . $id .
            " that goes from " . $request->start_point . " to " . $request->end_point], 404);
        $startPointOrder = $trip->start_point_order;
        $endPointOrder = $trip->end_point_order;
        // get all trips on this bus that user needs to check that are available and book to go from this start point to this end point
        $trips = Trip::where('bus_id', $busId)->where('start_point_order', '>=', $startPointOrder)->where('end_point_order', '<=', $endPointOrder)->get();
        // check to see if there is an available seats on all trips from start to end point on this bus before booking the seat
        foreach ($trips as $trip) {
            if ($trip->available_seats <= 0) return response()->json(["There is no seat available for this trip"], 405);
        }
        // now we decrease all the seats from start to end point on this bus by one
        Trip::where('bus_id', $busId)->where('start_point_order', '>=', $startPointOrder)->where('end_point_order', '<=', $endPointOrder)
            ->decrement('available_seats', 1);
        // we update seat in database with user_id and make it booked
        $seat->update(['user_id' => $user->id, 'booked' => 1]);
        return response()->json(["message" => "Seat booked Succesfully", "data" => $seat], 200);


    }

}
