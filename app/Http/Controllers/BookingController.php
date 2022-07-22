<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Seat;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Constants\HttpCode;

class BookingController extends Controller
{
    public function getSeats(Request $request)
    {
        // checking first to see if user provided a correct token and is authenticated
        $user = Auth::user();
        if (!$user) return response()->json(["message" => "Unauthorized"], HttpCode::HTTP_UNAUTHORIZED);
        // validate user input for start point and end point
        $validate = BookingRequest::validateBookingRequest($request->toArray());
        if ($validate) return response()->json([$validate], HttpCode::HTTP_BAD_REQUEST);
        // get all trips and busses from this start point and end point with available seats
        $trips = Trip::where('start_point', $request['start_point'])->where('end_point', $request['end_point'])
            ->where('available_seats', '>', 0)->get();
        $seats = [];
        // looping over trips for different busses
        foreach ($trips as $trip) {
            $availableBus = true;
            $startPointOrder = $trip['start_point_order'];
            $endPointOrder = $trip['end_point_order'];
            // getting trips in between for this bus to make sure they are available as well
            $tripsInBetween = Trip::where('bus_id', $trip['bus_id'])->where('start_point_order', '>=', $startPointOrder)->where('end_point_order', '<=', $endPointOrder)->get();
            // check to see if there are available seats on all trips from start to end point on this bus
            foreach ($tripsInBetween as $tripInBetween) {
                // if there is a trip in between on this bus which is not available,whole bus is not available and we should not return seats
                if ($tripInBetween['available_seats'] <= 0) $availableBus = false;
            }
            // when we made sure that whole trip on bus is available,we proceed to return seats for this bus
            if ($availableBus) {
                $tripSeats = $trip['bus']['seats'];
                foreach ($tripSeats as $seatObject) {
                    if (!$seatObject['booked']) {
                        $seat['seat_id'] = $seatObject['id'];
                        $seat['bus_id'] = $trip['bus']['id'];
                        $seat['start_point'] = $trip['start_point'];
                        $seat['end_point'] = $trip['end_point'];
                        $seats[] = $seat;
                    }
                }
            }

        }
        return response()->json(["Seats" => $seats], HttpCode::HTTP_OK);


    }

    public function bookSeat($id, Request $request)
    {
        // checking first to see if user provided a correct token and is authenticated
        $user = Auth::user();
        if (!$user) return response()->json(["message" => "Unauthorized"], HttpCode::HTTP_UNAUTHORIZED);
        // validate user input of start and end points and that it's a valid city
        $validate = BookingRequest::validateBookingRequest($request->toArray());
        if ($validate) return response()->json([$validate], HttpCode::HTTP_BAD_REQUEST);
        // check to see if this seat exists
        $seat = Seat::find($id);
        if (!$seat) return response()->json(["message" => "There is no seat with id = " . $id], HttpCode::HTTP_NOT_FOUND);
        // check to see if this seat is taken
        if ($seat['booked']) return response()->json(["message" => "The seat with id " . $id . " is already booked"], HttpCode::HTTP_METHOD_NOT_ALLOWED);
        $busId = $seat['bus_id'];
        // get trip that user will go on using start and end points
        $trip = Trip::where('bus_id', $busId)->where('start_point', $request['start_point'])->where('end_point', $request['end_point'])->first();
        if (!$trip) return response()->json(["message" => "There is no seat with id " . $id .
            " that goes from " . $request['start_point'] . " to " . $request['end_point']], HttpCode::HTTP_NOT_FOUND);
        $startPointOrder = $trip['start_point_order'];
        $endPointOrder = $trip['end_point_order'];
        // get all trips on this bus that user needs to pass through from this start point to end point to make sure that they are available
        $trips = Trip::where('bus_id', $busId)->where('start_point_order', '>=', $startPointOrder)->where('end_point_order', '<=', $endPointOrder)->get();
        // check to see if there is an available seats on all trips from start to end point on this bus before booking the seat
        foreach ($trips as $trip) {
            if ($trip['available_seats'] <= 0) return response()->json(["There is no seat available for this trip"], HttpCode::HTTP_NOT_FOUND);
        }
        // now we decrement all the seats from start to end point on this bus by one
        Trip::where('bus_id', $busId)->where('start_point_order', '>=', $startPointOrder)->where('end_point_order', '<=', $endPointOrder)
            ->decrement('available_seats', 1);
        // we update seat in database with user_id and make it booked
        $seat->update(['user_id' => $user['id'], 'booked' => 1]);
        return response()->json(["message" => "Seat booked Successfully", "data" => $seat], HttpCode::HTTP_OK);


    }

}
