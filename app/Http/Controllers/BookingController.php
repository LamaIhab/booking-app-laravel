<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Seat;
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

    public function bookSeat($id,Request $request)
    {
        // checking first to see if user provided a correct token and is authenticated
        $user = Auth::user();
        if (!$user) return response()->json(["message" => "Unauthorized"], 401);
        // validate user input of start and end points and that it's a valid city
        $validate = BookingRequest::validateBookingRequest($request->toArray());
        if($validate) return $validate;
        // check to see if this seat exists
        $seat = Seat::find($id);
        if(!$seat) return response()->json(["message" => "There is no seat with id = ".$id],404);
        // check to see if this seat is taken
        if($seat->booked) return response()->json(["message" => "The seat with id ".$id." is already booked"],405);


        // using start and end point and id of it ticket get from it bus_id,go to trips of this bus with this start and end point
        // and decrease seats then decrease all other trips of this bus between start and end point (USE CONDITION)
    }

}
