<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function getSeats(Request $request)
    {
        // checking first to see if user provided a correct token and is authenticated
        $user = Auth::user();
        if (!$user) return response()->json(["message" => "Unauthorized"], 401);
        else return 'authorized';
    }

    public function bookSeat($id)
    {
        // checking first to see if user provided a correct token and is authenticated
        $user = Auth::user();
        if (!$user) return response()->json(["message" => "Unauthorized"], 401);
        else return 'authorized';
    }

}
